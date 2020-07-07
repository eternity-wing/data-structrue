<?php

namespace App\Lib\BST;

/**
 * Class BSTArray.
 *
 * @author Wings<Eternity.mr8@gmail.com>
 */
class BSTArray
{

    /**
     * @var array
     */
    private $items = [];

    /**
     * @var integer
     */
    private $size = 0;


    public static function getRightChildIndex(int $index): int
    {
        return (($index * 2) + 2);
    }


    public static function getLeftChildIndex(int $index): int
    {
        return (($index * 2) + 1);
    }


    public function insert(int $value): void
    {
        if (0 === $this->size) {
            $this->items[0] = $value;
            $this->size++;
            return;
        }

        $traversedItemIndex = 0;
        while (true) {
            $traversedItemValue = $this->items[$traversedItemIndex];
            if ($traversedItemValue === $value) {
                return;
            }

            $isLessThanTraversedItem = $traversedItemValue > $value;
            $traversedItemLeftChildIndex = self::getLeftChildIndex($traversedItemIndex);
            $traversedItemLeftChild = $this->items[$traversedItemLeftChildIndex] ?? null;

            if ($isLessThanTraversedItem && $traversedItemLeftChild === null) {
                $this->items[$traversedItemLeftChildIndex] = $value;
                $this->size++;
                return;
            }

            if ($isLessThanTraversedItem) {
                $traversedItemIndex = $traversedItemLeftChildIndex;
                continue;
            }

            $isGreaterThanTraversedItem = $traversedItemValue < $value;
            $traversedItemRightChildIndex = self::getRightChildIndex($traversedItemIndex);
            $traversedItemRightChild = $this->items[$traversedItemRightChildIndex] ?? null;

            if ($isGreaterThanTraversedItem && $traversedItemRightChild === null) {
                $this->items[$traversedItemRightChildIndex] = $value;
                $this->size++;
                return;
            }

            if ($isGreaterThanTraversedItem) {
                $traversedItemIndex = $traversedItemRightChildIndex;
                continue;
            }
        }
    }


    public function find(int $value): int
    {
        return $this->search($value, 0);
    }

    public function search(int $value, int $itemIndex = 0): int
    {
        $itemValue = $this->items[$itemIndex] ?? false;
        if (false === $itemValue) {
            return -1;
        }
        if ($itemValue === $value) {
            return $itemIndex;
        }
        $leftChildIndex = self::getLeftChildIndex($itemIndex);
        $rightChildIndex = self::getRightChildIndex($itemIndex);
        $nextItemIndex = $itemValue > $value ? $leftChildIndex : $rightChildIndex;

        return $this->search($value, $nextItemIndex);
    }

    public function delete(int $value): void
    {
        $itemIndex = $this->find($value);

        if (-1 === $itemIndex) {
            return;
        }

        $itemLeftChildIndex = self::getLeftChildIndex($itemIndex);
        $itemLeftChild = $this->items[$itemLeftChildIndex] ?? null;

        $itemRightChildIndex = self::getRightChildIndex($itemIndex);
        $itemRightChild = $this->items[$itemRightChildIndex] ?? null;

        if (empty($itemLeftChild) && empty($itemRightChild)) {
            unset($this->items[$itemIndex]);
            return;
        }

        $replacedNodeIndex = $this->findMinChildValue(null !== $itemRightChild ? $itemRightChildIndex : $itemLeftChildIndex);

        $this->items[$itemIndex] = $this->items[$replacedNodeIndex];

        $replacedNodeRightChildIndex = self::getRightChildIndex($replacedNodeIndex);
        $replacedNodeRightChild = $this->items[$replacedNodeRightChildIndex] ?? null;

        if (null !== $replacedNodeRightChild) {
            $this->items[$replacedNodeIndex] = $this->items[$replacedNodeRightChild];
            unset($this->items[$replacedNodeRightChild]);
        } else {
            unset($this->items[$replacedNodeIndex]);
        }
    }


    private function findMinChildValue(int $itemIndex): int
    {
        $leftChildIndex = self::getLeftChildIndex($itemIndex);
        if (isset($this->items[$leftChildIndex])) {
            return $this->findMinChildValue($leftChildIndex);
        }

        return $itemIndex;
    }


    public function printTree(int $rootIndex = 0): void
    {
        $item = $this->items[$rootIndex] ?? false;
        if (false === $item) {
            return;
        }

        $this->printTree(self::getLeftChildIndex($rootIndex));
        echo $item . "\n";
        $this->printTree(self::getRightChildIndex($rootIndex));
    }


    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }


    /**
     * @return integer
     */
    public function getSize(): int
    {
        return $this->size;
    }
}
