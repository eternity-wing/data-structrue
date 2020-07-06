<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Lib\BST\BSTArray;

function main(){
    $bstArray = new BSTArray();

    $generatedItems = [10, 78, 2, 1, 24, 100, -1];
    foreach ($generatedItems as $generatedItem){
        $bstArray->insert($generatedItem);
    }

    $bstArray->printTree(0);
    $searchItem = 24;
    echo "Search for {$searchItem}:\n";
    echo 'Founded index: ' . $bstArray->find($searchItem) . "\n";
    $bstArray->delete(24);
    echo "\nmostafa\n";
    $bstArray->printTree(0);

}


main();