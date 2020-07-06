<?php

namespace App\Lib\BST;

class BinarySearchTree
{
    /**
     * @var Node|null
     */
    private $root = null;

    /**
     * @var array
     */
    private $arrayStorage = [];

    public function __construct()
    {
    }
    public function insert(int $value): void{
        $this->insertInLinkedList($value);
        $this->insertInArray($value);
    }
    private function insertInLinkedList(int $value): void{
        $node = new Node($value);
        if(null === $this->root){
            $this->root = $node;
            $this->arrayStorage[0] = $value;
            return;
        }
        $nodeIndex = 0;
        $currentNode = $this->root;
        while (true){
            $leftChildIndex = $nodeIndex + 1;
            $rightChildIndex = $nodeIndex + 2;

            if($currentNode->getValue() === $node->getValue()){
                return;
            }

            $isLessThanCurrentNode = $currentNode->getValue() > $node->getValue();
            if ($isLessThanCurrentNode && null === $currentNode->getLeft()) {
                $node->setParent($currentNode);
                $currentNode->setLeft($node);
                $this->arrayStorage[$leftChildIndex] = $value;
                return;
            }

            if($isLessThanCurrentNode) {
                $currentNode = $currentNode->getLeft();
                $nodeIndex = $leftChildIndex;
                continue;
            }

            $isGreaterThanCurrentNode = $currentNode->getValue() < $node->getValue();
            if ($isGreaterThanCurrentNode && null === $currentNode->getRight()) {
                $node->setParent($currentNode);
                $currentNode->setRight($node);
                $this->arrayStorage[$rightChildIndex] = $value;
                return;
            }

            if($isGreaterThanCurrentNode) {
                $currentNode = $currentNode->getRight();
                $nodeIndex = $rightChildIndex;
                continue;
            }
        }
    }
    private function insertInArray(int $value): void{
        if(!isset($this->arrayStorage[0])){
            $this->arrayStorage[0] = $value;
            return;
        }
        $traversedNodeIndex = 0;
        while (true){
            $traversedNodeValue = $this->arrayStorage[$traversedNodeIndex];
            if($traversedNodeValue === $value){
                return;
            }

            $isLessThanTraversedNode = $traversedNodeValue > $value;
            $traversedNodeLeftChildIndex = $traversedNodeIndex + 1;
            $traversedNodeLeftChild = $this->arrayStorage[$traversedNodeLeftChildIndex] ?? null;

            if ($isLessThanTraversedNode && $traversedNodeLeftChild !== null) {
                $this->arrayStorage[$traversedNodeLeftChildIndex] = $value;
                return;
            }

            if($isLessThanTraversedNode) {
                $traversedNodeIndex = $traversedNodeLeftChildIndex;
                continue;
            }

            $isGreaterThanTraversedNode = $traversedNodeValue < $value;
            $traversedNodeRightChildIndex = $traversedNodeIndex + 2;
            $traversedNodeRightChild = $this->arrayStorage[$traversedNodeRightChildIndex] ?? null;

            if ($isGreaterThanTraversedNode && $traversedNodeRightChild !== null) {
                $this->arrayStorage[$traversedNodeRightChildIndex] = $value;
                return;
            }

            if($isGreaterThanTraversedNode) {
                $traversedNodeIndex = $traversedNodeRightChildIndex;
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

    public function findInArrayStorage(int $value): int{
        $nodeIndex = 0;
        while ($nodeValue = $this->arrayStorage[$nodeIndex] ?? false){

            if($nodeValue === $value){
                return $nodeIndex;
            }
            $rightChildIndex = $nodeIndex + 1;
            $leftChildIndex = $nodeIndex + 2;
            $nodeIndex = $nodeValue > $value ? $rightChildIndex : $leftChildIndex;
        }
        return -1;
    }

    public function delete(int $value): void{
        $foundedNode = $this->find($value);

        if(null === $foundedNode){
            return;
        }
        if($foundedNode->isLeaf()){
           unset($foundedNode);
           return;
        }

        $replacedNode = $foundedNode->getRight() ? $this->findMinChildNode($foundedNode->getRight()) : $foundedNode->getLeft();
        $foundedNode->setValue($replacedNode->getValue());
        unset($replacedNode);
    }

    private function findMinChildNode(Node $node): Node{
        if($node->getLeft()){
            return $this->findMinChildNode($node->getLeft());
        }
        return $node;
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

    /**
     * @return array
     */
    public function getArrayStorage(): array
    {
        return $this->arrayStorage;
    }

}