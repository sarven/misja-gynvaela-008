<?php

namespace LIDAR\Point;

use LIDAR\Entity\Data;
use LIDAR\Entity\Distance;
use LIDAR\Entity\Point;

/**
 * Class PointCalculator
 * @package LIDAR\Point
 */
final class PointCalculator implements PointCalculatorInterface
{
    /**
     * @param Data $data
     * @return Point[]
     */
    public function calc(Data $data): array
    {
        $points = [];

        foreach ($data->getDistances() as $distance) {
            $point = $this->calcPoint($distance, $data->getPoint());

            if ($point) {
                $points[] = $point;
            }
        }

        return $points;
    }

    /**
     * @param Distance $distance
     * @param Point $point
     * @return Point|null
     */
    private function calcPoint(Distance $distance, Point $point): ?Point
    {
        if ($distance->getDistance() === -1.0) {
            return null;
        }

        $angle = $distance->getAngle() * M_PI / 180;
        $x = round(sin($angle) * $distance->getDistance() + $point->getX());
        $y = round(-cos($angle) * $distance->getDistance() + $point->getY());

        return (new Point())
            ->setX($x)
            ->setY($y)
        ;
    }
}