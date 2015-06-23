<?php

define('TEST_PATH', __DIR__);

require TEST_PATH  . '/../src/SplClassLoader.php';

$oClassLoader = new \SplClassLoader('App', __DIR__ . '/../src');
$oClassLoader->register();
