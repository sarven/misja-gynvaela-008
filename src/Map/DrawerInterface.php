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
     * @param Data $data
     */
    public function draw(Data $data): void;
}