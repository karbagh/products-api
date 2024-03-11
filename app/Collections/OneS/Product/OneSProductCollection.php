<?php

namespace App\Collections\OneS\Product;

use App\Entites\OneS\Product\OneSProductEntity;
use App\Enums\Language\Language;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\Unit;
use App\Models\UnitTranslation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Iterator;

class OneSProductCollection
{
    private array $items;

    public function setItems(Iterator $iterator): self
    {
        foreach ($iterator as $item) {
            if (strlen($item->CategoryCode->__toString()) > 1) {
                $productEntity = new OneSProductEntity();
                $productEntity->setCode($item->Code);
                $productEntity->setArticle($item->Article->__toString() ? $item->Article : null);
                $productEntity->setName($item->Name);
                $productEntity->setBarcode($item->Barcode->__toString() ? $item->Barcode : null);
                $productEntity->setPrice((float) $item->Price_Old);
                $productEntity->setInStock(1);
                $productEntity->setDiscountPercent((float)$item->DiscountPercent);
                $productEntity->setActive($item->Active->__toString() === 'true');
                $productEntity->setUnit($item->Unit);
                $productEntity->setBrand($item->Brand->__toString() ? $item->Brand : null);
                $productEntity->setDescription($item->Description);
                $productEntity->setCategoryCode($item->CategoryCode);
                $productEntity->setAdgCode($item->ADG->__toString() ? $item->ADG : null);
                $this->items[] = $productEntity;
            } else {
                Log::info('missing category code', [$item->Code, $item->Name, $item->CategoryCode->__toString()]);
            }
        }

        return $this;
    }

    public function count(): int
    {
        return count($this->getItems());
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function pluckByCode(): array
    {
        return array_map(function (OneSProductEntity $item) {
            return $item->getCategoryCode();
        }, $this->getItems());
    }

    public function pluckByUnit(): array
    {
        return array_unique(array_map(function (OneSProductEntity $item) {
            return $item->getUnit();
        }, $this->getItems()));
    }

    public function pluckByBrand(): array
    {
        return array_unique(array_filter(array_map(function (OneSProductEntity $item) {
            return $item->getBrand();
        }, $this->getItems())));
    }

    public function getSaveDataOfEntities(): array
    {
        $units = UnitTranslation::query()->where('locale', 'hy')
            ->whereIn('name', $this->pluckByUnit())
            ->pluck('unit_id', 'name');

        $categories = Category::query()->whereIn('os_id', $this->pluckByCode())
            ->pluck('id', 'os_id');

        $toSaveBrands = [];
        foreach ($this->pluckByBrand() as $brand) {
            $toSaveBrands[] = ['name' => $brand];
        }
        Brand::query()->upsert($toSaveBrands, 'name');
        $brands = Brand::query()->whereIn('name', $this->pluckByBrand())
            ->pluck('id', 'name');

        return array_map(function (OneSProductEntity $product) use ($units, $categories, $brands) {
            if ($product->getCategoryCode()) {
                return $product->toSaveData($units, $categories, $brands);
            } else {
                Log::info('missing category code', [$product->Code, $product->Name, $product->CategoryCode->__toString()]);
            }
        }, $this->getItems());
    }

    public function getSaveTranslationsOfEntities(): array
    {
        $products = Product::query()->whereDoesntHave('translations')->pluck('id', 'os_id');

        $translations = [];
        foreach ($this->getItems() as $product) {
            $translations = array_merge($translations, array_values($product->toSaveTranslationData($products)));
        }
        return $translations;
    }
}
