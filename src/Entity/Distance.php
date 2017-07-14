<?php

namespace LIDAR\Entity;

/**
 * Class Distance
 * @package LIDAR\Entity
 */
class Distance
{
    /**
     * @var int
     */
    private $angle;

    /**
     * @var float
     */
    private $distance;

    /**
     * @return int
     */
    public function getAngle(): int
    {
        return $this->angle;
    }

    /**
     * @param int $angle
     * @return Distance
     */
    public function setAngle(int $angle): Distance
    {
        $this->angle = $angle;

        return $this;
    }

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     * @return Distance
     */
    public function setDistance(float $distance): Distance
    {
        $this->distance = $distance;

        return $this;
    }
}