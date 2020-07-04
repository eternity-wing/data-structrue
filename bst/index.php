<?php
require 'BinarySearchTree.php';

function main(){
    $bst = new BinarySearchTree();

    $generatedItems = [];
    for ($i = 0 ; $i <= 20 ; $i++){
        $randomNumber = random_int(1, 15);
        $generatedItems[] = $randomNumber;
        $bst->insert($randomNumber);
    }

    $rand_key = array_rand($generatedItems);
    $foundedItem = $bst->find($generatedItems[$rand_key]);
    echo $foundedItem->getValue() ."\n" . $generatedItems[$rand_key] ."\n array::";

    foreach (array_unique($generatedItems) as $generatedItem){
        echo $generatedItem ."\n";
    }
    echo "tree \n";
    showTree($bst->getRoot());

}

function showTree(?Node $node){
    if(null === $node){
        return;
    }
    showTree($node->getLeft());
    echo $node->getValue() . "\n";
    showTree($node->getRight());
}

main();