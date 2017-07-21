<?php

namespace LIDAR\Map;

use LIDAR\Entity\Data;

/**
 * Interface DrawerInterface
 * @package LIDAR\Map
 */
interface DrawerInterface
{
    /**
     * @return resource
     */
    public function createMap();

    /**
     * @param resource $map
     * @param Data $data
     */
    public function draw($map, Data $data): void;

    /**
     * @param resource $map
     */
    public function saveMap($map);
}