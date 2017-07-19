<?php

namespace LIDAR\Point;

use LIDAR\Entity\Data;
use LIDAR\Entity\Point;

/**
 * Interface PointCalculatorInterface
 * @package LIDAR\Point
 */
interface PointCalculatorInterface
{
    /**
     * @param Data $data
     * @return Point[]
     */
    public function calc(Data $data): array;
}