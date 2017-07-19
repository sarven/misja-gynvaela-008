<?php

require __DIR__ . '/vendor/autoload.php';

$fileHandler = new LIDAR\File\FileHandler();
$output = new LIDAR\Console\Output();
$dataParser = new LIDAR\Parser\DataParser();
$pointCalculator = new LIDAR\Point\PointCalculator();
$drawer =  new LIDAR\Map\Drawer($pointCalculator);

$solver = new LIDAR\Solver\Solver(
    $fileHandler,
    $output,
    $dataParser,
    $drawer
);

$solver->solve();