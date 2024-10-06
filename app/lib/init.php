<?php

$urlSplit = preg_split('/[\\\\\/]/', __DIR__);
print_r($urlSplit);
$urlSlice = array_slice($urlSplit, 0, -1);
$path = implode('/', $urlSlice) . '/';
define('ROOT_PATH', $path);
