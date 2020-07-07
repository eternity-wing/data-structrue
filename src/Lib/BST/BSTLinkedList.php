<?php

namespace App\Lib\BST;

/**
 * Class BinarySearchTree.
 * @package App\Lib\BST
 * @author Wings<Eternity.mr8@gmail.com>
 */
class BSTLinkedList
{
    /**
     * @var Node|null
     */
    private $root = null;

    public function insert(int $value): void
    {
        $node = new Node($value);
        $acceptorNode = $this->getAcceptorNode($value, $this->root);
        if ($acceptorNode === null) {
            $this->root = $this->root ?? $node;
            return;
        }
        $node->setParent($acceptorNode);
        $acceptorNode->getValue() > $value ? $acceptorNode->setLeft($node) : $acceptorNode->setRight($node);

    }


    private function getAcceptorNode(int $value, ?Node $currentNode = null): ?Node
    {
        $currentNodeValue = $currentNode ? $currentNode->getValue() : null;
        if ($currentNodeValue === null) {
            return null;
        }

        $leftChild = $currentNode->getLeft();
        $rightChild = $currentNode->getRight();

        $isLessThanCurrentNode = $currentNodeValue > $value;
        $canBeInsertedInLeft = $isLessThanCurrentNode && null === $leftChild;
        $canBeInsertedInRight = !$isLessThanCurrentNode && null === $rightChild;
        if ($canBeInsertedInLeft || $canBeInsertedInRight || $currentNode->isLeaf()) {
            return $currentNode;
        }
        return $this->getAcceptorNode($value, $isLessThanCurrentNode ? $leftChild : $rightChild);
    }


    public function find(int $value): ?Node
    {
        return $this->search($value, $this->root);
    }

    private function search(int $value, Node $node): ?Node
    {
        if ($node->getValue() === $value) {
            return $node;
        }
        $nextNode = $node->getValue() > $value ? $node->getLeft() : $node->getRight();
        return $nextNode !== null ? $this->search($value, $nextNode) : null;
    }

    public function delete(int $value): void
    {
        $foundedNode = $this->find($value);
        if (null === $foundedNode) {
            return;
        }

        if ($foundedNode->isLeaf()) {
            $foundedNode->onRemove();
            unset($foundedNode);
            return;
        }

        $nodeRightChild = $foundedNode->getRight();
        if ($nodeRightChild) {
            $replacedNode = $this->findMinChildNode($nodeRightChild);
            $foundedNode->setValue($replacedNode->getValue());
            $replacedNode->onRemove();
            unset($replacedNode);
            return;
        }

        $nodeLeftChild = $foundedNode->getLeft();
        $foundedNodeParent = $foundedNode->getParent();
        if ($foundedNodeParent->getRight() === $foundedNode) {
            $foundedNodeParent->setRight($nodeLeftChild);
        } else {
            $foundedNodeParent->setLeft($nodeLeftChild);
        }
        $nodeLeftChild->setParent($foundedNodeParent);
        $foundedNode->onRemove();
        unset($foundedNode);
    }

    public function printTree(?Node $root = null): void
    {
        if ($root === null) {
            return;
        }

        $this->printTree($root->getLeft());
        echo $root->getValue() . "\n";
        $this->printTree($root->getRight());
    }

    private function findMinChildNode(Node $node): Node
    {
        if ($node->getLeft()) {
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
}
