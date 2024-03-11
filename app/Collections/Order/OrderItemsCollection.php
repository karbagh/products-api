<?php

namespace App\Collections\Order;

use App\Collections\Collection;
use App\Entites\Order\OrderItemEntity;
use App\Models\Product;

class OrderItemsCollection extends Collection
{
    /**
     * @var
     */
    protected array $items;
    private float $subtotal = 0.000;
    private float $discount = 0.000;
    private float $total = 0.000;

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    /**
     * @param float $subtotal
     */
    public function setSubtotal(float $subtotal): void
    {
        $this->subtotal = $subtotal;
    }

    /**
     * @return float
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * @param float $discount
     */
    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     */
    public function setTotal(float $total): void
    {
        $this->total = $total;
    }

    public function calculateCosts(): void
    {
        $this->setSubtotal(array_sum($this->pluck('subtotal')));
        $this->setDiscount(array_sum($this->pluck('discount')));
        $this->setTotal(array_sum($this->pluck('total')));
    }

    /**
     * @param array $items
     * @return OrderItemsCollection
     */
    public function setItems(array $items): self
    {
        $products = Product::query()->whereIn('uuid', array_column($items, 'id'))->get();
        $this->items = array_map(function ($item) use ($products) {
            $order = new OrderItemEntity();

            $order->setCount($item['count']);
            $order->setUuid($item['id']);
            $order->setProduct($products->where('uuid', $item['id'])->first());
            return $order;
        }, $items);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($item) {
            return [
                'count' => $item->getCount(),
                'uuid' => $item->getUuid(),
                'product' => $item->getProduct(),
                'subtotal' => $item->getSubtotal(),
                'discount' => $item->getDiscount(),
                'total' => $item->getTotal(),
            ];
        }, $this->items);
    }

    public function pluck($value, $key = null)
    {
        return array_map(function ($item) use ($value) {
            return $item[$value];
        }, $this->toArray());
    }

    public function findByUuid(string $uuid): OrderItemEntity
    {
        return current(array_filter($this->items, function ($item) use ($uuid) {
            return $item->getUuid() == $uuid;
        }));
    }
}
