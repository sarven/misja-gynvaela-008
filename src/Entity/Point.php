<?php

namespace LIDAR\Entity;

/**
 * Class Point
 * @package LIDAR\Entity
 */
class Point
{
    /**
     * @var int
     */
    private $x;

    /**
     * @var int
     */
    private $y;

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return Point
     */
    public function setX(int $x): Point
    {
        $this->x = $x;

        return $this;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     * @return Point
     */
    public function setY(int $y): Point
    {
        $this->y = $y;

        return $this;
    }
}