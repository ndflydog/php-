<?php

$list = new SplDoublyLinkedList();
$list->push('a');
$list->push('b');
$list->push('c');
$list->push('d');

$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO);
for ($list->rewind(); $list->valid(); $list->next()) {
    echo $list->current().PHP_EOL;
}

echo $list->count();
