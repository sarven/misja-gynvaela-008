<?php

require __DIR__ . '/vendor/autoload.php';

$fileHandler = new LIDAR\File\FileHandler();
$output = new LIDAR\Console\Output();
$dataParser = new LIDAR\Parser\DataParser();

$crawler = new LIDAR\Crawler\Crawler($fileHandler, $output, $dataParser);

$crawler->run();
