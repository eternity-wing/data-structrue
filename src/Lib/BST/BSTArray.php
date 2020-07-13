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
        $recipientIndex = $this->getRecipientIndex($value, 0);
        if(!isset($this->items[$recipientIndex])){
            $this->items[$recipientIndex] = $value;
            $this->size++;
            return;
        }

    }

    public function find(int $value): ?int
    {
        return $this->items[$this->getRecipientIndex($value, 0)] ?? null;
    }

    public function getRecipientIndex(int $score, int $currentIndex = 0): ?int
    {
        $currentValue = $this->items[$currentIndex] ?? null;
        if ($currentValue === null || $score === $currentValue) {
            return $currentIndex;
        }

        $leftChildIndex = self::getLeftChildIndex($currentIndex);
        $rightChildIndex = self::getRightChildIndex($currentIndex);

        $leftChild = $this->items[$leftChildIndex] ?? null;
        $rightChild = $this->items[$rightChildIndex] ?? null;

        $isLessThanCurrentValue = $currentValue > $score;
        $canBeInsertedInLeft = $isLessThanCurrentValue && null === $leftChild;
        $canBeInsertedInRight = !$isLessThanCurrentValue && null === $rightChild;

        if ($canBeInsertedInLeft || $canBeInsertedInRight) {
            return $canBeInsertedInLeft ? $leftChildIndex : $rightChildIndex;
        }

        return $this->getRecipientIndex($score, $isLessThanCurrentValue ? $leftChildIndex : $rightChildIndex);
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
