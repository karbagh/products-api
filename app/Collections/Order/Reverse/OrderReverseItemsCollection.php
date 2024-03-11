<?php

namespace App\Collections\Order\Reverse;

use App\Entites\Order\Reverse\OrderReverseItemEntity;
use App\Models\Order;
use Closure;

class OrderReverseItemsCollection
{
    protected array $items;

    public function setItems(Order $order, array $items): self
    {
        $orderItems = $order->items()->whereIn('id', array_column($items, 'id'))->get();
        $this->items = array_map(function ($item) use ($orderItems) {
            $order = new OrderReverseItemEntity();

            $order->setCount($item['count']);
            $order->setOrderItem($orderItems->find($item['id']));
            return $order;
        }, $items);

        return $this;
    }

    public function toSaveArray(int $orderReverseId): array
    {
        return array_map(
            function (OrderReverseItemEntity $item) use ($orderReverseId) {
                return [
                    'order_reverse_id' => $orderReverseId,
                    'order_list_id' => $item->getOrderItem()->id,
                    'total' => $item->getOrderItem()->itemPrice * $item->getCount(),
                    'count' => $item->getCount(),
                ];
            },
            $this->items
        );
    }

    public function each(Closure $callback)
    {
        return array_map($callback, $this->items);
    }
}
