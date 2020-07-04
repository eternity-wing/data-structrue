<?php

require 'Node.php';

class BinarySearchTree
{
    /**
     * @var Node|null
     */
    private $root = null;

    public function __construct()
    {
    }
    public function insert(int $value): void{
        $node = new Node($value);
        if(null === $this->root){
            $this->root = $node;
            return;
        }
        $currentNode = $this->root;
        while (true){

            if($currentNode->getValue() === $node->getValue()){
                return;
            }

            $isLessThanCurrentNode = $currentNode->getValue() > $node->getValue();
            if ($isLessThanCurrentNode && null === $currentNode->getLeft()) {
                $node->setParent($currentNode);
                $currentNode->setLeft($node);
                return;
            }

            if($isLessThanCurrentNode) {
                $currentNode = $currentNode->getLeft();
                continue;
            }

            $isGreaterThanCurrentNode = $currentNode->getValue() < $node->getValue();
            if ($isGreaterThanCurrentNode && null === $currentNode->getRight()) {
                $node->setParent($currentNode);
                $currentNode->setRight($node);
                return;
            }

            if($isGreaterThanCurrentNode) {
                $currentNode = $currentNode->getRight();
                continue;
            }


        }
    }

    public function find(int $value): ?Node{
        $currentNode = $this->root;
        while (null !== $currentNode){

            if($currentNode->getValue() === $value){
                return $currentNode;
            }

            $currentNode = $currentNode->getValue() > $value ? $currentNode->getLeft() : $currentNode->getRight();
        }
        return null;
    }

    /**
     * @return Node|null
     */
    public function getRoot(): ?Node
    {
        return $this->root;
    }

    /**
     * @param Node|null $root
     */
    public function setRoot(?Node $root): void
    {
        $this->root = $root;
    }
}