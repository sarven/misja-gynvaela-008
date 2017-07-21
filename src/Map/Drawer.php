<?php

namespace LIDAR\Map;

use LIDAR\Entity\Data;
use LIDAR\Entity\Point;
use LIDAR\Point\PointCalculator;

/**
 * Class Drawer
 * @package LIDAR\Map
 */
final class Drawer implements DrawerInterface
{
    const MAP_FILE = __DIR__.'/../../map/map.jpg';
    const WIDTH = 2000;
    const HEIGHT = 2000;
    const COLOR = [
        'R' => 0,
        'G' => 0,
        'B' => 0
    ];
    const RATIO = 2;

    /**
     * @var PointCalculator
     */
    private $pointCalculator;

    /**
     * Drawer constructor.
     * @param PointCalculator $pointCalculator
     */
    public function __construct(PointCalculator $pointCalculator)
    {
        $this->pointCalculator = $pointCalculator;
    }

    /**
     * {@inheritdoc}
     */
    public function saveMap($map): void
    {
        imagejpeg($map, self::MAP_FILE);
    }

    /**
     * {@inheritdoc}
     */
    public function createMap()
    {
        $image = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);
        imagejpeg($image, self::MAP_FILE);

        return $image;
    }

    /**
     * {@inheritdoc}
     */
    public function draw($map, Data $data): void
    {
        $points = $this->pointCalculator->calc($data);
        $this->drawPoints($map, $points);
    }

    /**
     * @param resource $map
     * @param Point[] $points
     */
    private function drawPoints($map, array $points): void
    {
        foreach ($points as $point) {
            $this->drawPoint($map, $point);
        }
    }

    /**
     * @param resource $map
     * @param Point $point
     */
    private function drawPoint($map, Point $point): void
    {
        $black = imagecolorallocate($map, self::COLOR['R'], self::COLOR['G'], self::COLOR['B']);
        imagefilledarc($map, self::RATIO * $point->getX(), self::RATIO * $point->getY(), 1, 1, 0, 360, $black, IMG_ARC_PIE);
    }
}