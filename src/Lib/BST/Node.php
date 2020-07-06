<?php

namespace App\Lib\BST;

/**
 * Class Node.
 * @author Wings<Eternity.mr8@gmail.com>
 */
class Node
{
    /**
     * @var Node|null
     */
    private $parent;
    /**
     * @var Node|null
     */
    private $left;
    /**
     * @var Node|null
     */
    private $right;
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value , ?Node $parent = null)
    {
        $this->value = $value;
        $this->parent = $parent;
    }

    public function getSibling(): ?Node{
        $parentLeftChild = $this->parent ? $this->parent->getLeft() : null;
        $parentRightChild = $this->parent ? $this->parent->getRight() : null;
        if(null === $parentLeftChild || null === $parentRightChild){
            return null;
        }

        if($parentLeftChild !== $this){
            return $parentLeftChild;
        }

        if($parentRightChild !== $this){
            return $parentRightChild;
        }

        return null;
    }

    public function isLeaf(): bool{
       return !$this->hasChild();
    }
    public function hasChild(): bool{
        return $this->getRight() !== null || $this->getRight() !== null;
    }

    public function __destruct()
    {
        if($this->left){
            $this->left->parent = null;
        }

        if($this->right){
            $this->right->parent = null;
        }

        if(null === $this->parent){
            return;
        }
        if($this->parent->getRight() === $this){
            $this->parent->setRight(null);
        }
        if($this->parent->getLeft() === $this){
            $this->parent->setLeft(null);
        }
    }

    /**
     * @return Node|null
     */
    public function getParent(): ?Node
    {
        return $this->parent;
    }

    /**
     * @param Node|null $parent
     */
    public function setParent(?Node $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Node|null
     */
    public function getLeft(): ?Node
    {
        return $this->left;
    }

    /**
     * @param Node|null $left
     */
    public function setLeft(?Node $left): void
    {
        $this->left = $left;
    }

    /**
     * @return Node|null
     */
    public function getRight(): ?Node
    {
        return $this->right;
    }

    /**
     * @param Node|null $right
     */
    public function setRight(?Node $right): void
    {
        $this->right = $right;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

}