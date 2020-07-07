<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Lib\BST\BSTArray;
use App\Lib\BST\BSTLinkedList;

function main()
{
    $bstArray = new BSTArray();
    $bstLinkedList = new BSTLinkedList();

    $generatedItems = [10, 78, 2, 1, 24, 100, -1, 0, 5, 20];
    foreach ($generatedItems as $generatedItem) {
        $bstArray->insert($generatedItem);
        $bstLinkedList->insert($generatedItem);
    }

//    $bstArray->printTree(0);
    $bstLinkedList->printTree($bstLinkedList->getRoot());

//    echo "\n \n";
//    var_dump(serialize($bstLinkedList->getRoot()));
//    echo 'Remove: ' . $searchItem . " , -1\n";
//    $bstArray->delete($searchItem);
//    $bstArray->delete(-1);
//    echo "\nresult:\n";
//    $bstArray->printTree(0);
}


main();
