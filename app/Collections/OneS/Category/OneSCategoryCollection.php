<?php

namespace App\Collections\OneS\Category;

use App\Entites\OneS\Category\OneSCategoryEntity;
use Closure;
use Iterator;

class OneSCategoryCollection
{
    private array $items;

    public function setItems(Iterator $iterator): self
    {
        foreach ($iterator as $item) {
            $categoryEntity = new OneSCategoryEntity();
            $categoryEntity->setCode($item->Code);
            $categoryEntity->setName($item->Name);
            $categoryEntity->setDiscountBonus($item->DiscountBonus->__toString());
            $categoryEntity->setParentCode(strlen($item->ParentCode->__toString()) ? $item->ParentCode->__toString() : null);
            $this->items[] = $categoryEntity;
        }

        return $this;
    }

    public function filter(Closure $callback): array
    {
        return array_filter($this->items, $callback);
    }

    public function getWithoutParents(): array
    {
        return $this->filter(function (OneSCategoryEntity $item) {
            return $item->getParentCode() === null;
        });
    }

    public function getWithParents(): array
    {
        return $this->filter(function (OneSCategoryEntity $item) {
            return $item->getParentCode();
        });
    }
}
