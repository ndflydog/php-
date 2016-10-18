<?php
//php SPL内置迭代器
$fileSystem = new FilesystemIterator('./');

for ($fileSystem->rewind(); $fileSystem->valid(); $fileSystem->next()) {
    echo $fileSystem->current();
}
