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
     * @var resource
     */
    private $image;

    /**
     * Drawer constructor.
     * @param PointCalculator $pointCalculator
     */
    public function __construct(PointCalculator $pointCalculator)
    {
        $this->pointCalculator = $pointCalculator;
        $this->image = $this->getImage();
    }

    /**
     * @param Data $data
     */
    public function draw(Data $data): void
    {
        $points = $this->pointCalculator->calc($data);
        $this->drawPoints($points);
    }

    /**
     * @param Point[] $points
     */
    private function drawPoints(array $points): void
    {
        foreach ($points as $point) {
            $this->drawPoint($point);
        }
    }

    /**
     * @param Point $point
     */
    private function drawPoint(Point $point): void
    {
        $black = imagecolorallocate($this->image, self::COLOR['R'], self::COLOR['G'], self::COLOR['B']);
        imagefilledarc($this->image, self::RATIO * $point->getX(), self::RATIO * $point->getY(), 1, 1, 0, 360, $black, IMG_ARC_PIE);
        imagejpeg($this->image, self::MAP_FILE);
    }

    /**
     * @return resource
     */
    private function getImage()
    {
        $image = imagecreatetruecolor(self::WIDTH, self::HEIGHT);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);
        imagejpeg($image, self::MAP_FILE);

        return $image;
    }
}