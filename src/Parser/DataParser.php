<?php

namespace LIDAR\Parser;

use LIDAR\Entity\Data;
use LIDAR\Entity\Distance;
use LIDAR\Entity\Point;

/**
 * Class DataParser
 * @package LIDAR\Parser
 */
final class DataParser implements DataParserInterface
{
    /**
     * {@inheritdoc}
     */
    public function parse(string $content): Data
    {
        $rows = static::stringToArray($content);
        $data = static::createData();

        $data->setPoint(static::parsePoint($rows));
        $data->setDistances(static::parseDistances($rows));
        $data->setLinks(static::parseLinks($rows));

        return $data;
    }

    /**
     * @param string $content
     * @return array
     */
    private static function stringToArray(string $content): array
    {
        return explode(PHP_EOL, $content);
    }

    /**
     * @param array $rows
     * @return Point
     */
    private static function parsePoint(array $rows): Point
    {
        $coordinates = explode(' ', $rows[1]);

        return (new Point())
            ->setX($coordinates[0])
            ->setY($coordinates[1])
        ;
    }

    /**
     * @param array $rows
     * @return Distance[]
     */
    private static function parseDistances(array $rows): array
    {
        $distances = [];
        for ($i = 2, $angle = 0; $i < count($rows) - 4; $i++, $angle += 10) {
            $distance = $rows[$i] !== Data::INFINITY ? $rows[$i] : -1;

            $distances[] = (new Distance())
                ->setAngle($angle)
                ->setDistance($distance)
            ;
        }

        return $distances;
    }

    /**
     * @param array $rows
     * @return array
     */
    private static function parseLinks(array $rows): array
    {
        $lastIndex = count($rows) - 1;

        return [
            'east' => static::parseFileName($rows[$lastIndex-3]),
            'west' => static::parseFileName($rows[$lastIndex-2]),
            'south' => static::parseFileName($rows[$lastIndex-1]),
            'north' => static::parseFileName($rows[$lastIndex])
        ];
    }

    /**
     * @param string $name
     * @return string
     */
    private static function parseFileName(string $name): string
    {
        return explode(': ', $name)[1];
    }

    /**
     * @return Data
     */
    private static function createData(): Data
    {
        return new Data();
    }
}