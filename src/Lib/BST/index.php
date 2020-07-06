<?php
//require 'BinarySearchTree.php';
//
//function main(){
//    $bst = new BinarySearchTree();
//
//    $generatedItems = [];
//    for ($i = 0 ; $i <= 20 ; $i++){
//        $randomNumber = random_int(1, 15);
//        $generatedItems[] = $randomNumber;
//        $bst->insert($randomNumber);
//    }
//
//    foreach (array_unique($generatedItems) as $generatedItem){
//        echo $generatedItem ."\n";
//    }
//    echo "tree \n";
//    showTree($bst->getRoot());
//
//    $rand_key = array_rand($generatedItems);
//    $bst->delete($generatedItems[$rand_key]);
//    echo "\n  deleting: " . $generatedItems[$rand_key] ."\n";
//
//    $rand_key = array_rand($generatedItems);
//    $bst->delete($generatedItems[$rand_key]);
//    echo "\n deleting: " . $generatedItems[$rand_key] ."\n";
//
//    showTree($bst->getRoot());
//
//}
//
//function showTree(?Node $node){
//    if(null === $node){
//        return;
//    }
//    showTree($node->getLeft());
//    echo $node->getValue() . "\n";
//    showTree($node->getRight());
//}
//
//main();