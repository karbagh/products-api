<?php

namespace App\Collections;

use App\Entites\Order\OrderItemEntity;
use Generator;

abstract class Collection
{
    /**
     * @param array $items
     * @return $this
     */
    abstract public function setItems(array $items): self;

    /**
     * @return array
     */
    abstract public function toArray(): array;

    /**
     * @return Generator
     */
    public function getItems(): Generator
    {
        foreach ($this->items as $item) {
            yield $item;
        }
    }
}
