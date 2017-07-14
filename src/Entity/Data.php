<?php

namespace LIDAR\Entity;

/**
 * Class Data
 * @package LIDAR\Entity
 */
class Data
{
    CONST DIRECTIONS = ['east', 'west', 'south', 'north'];
    /**
     * @var Point
     */
    private $point;

    /**
     * @var Distance[]
     */
    private $distances;

    /**
     * @var string
     */
    private $east;

    /**
     * @var string
     */
    private $west;

    /**
     * @var string
     */
    private $south;

    /**
     * @var string
     */
    private $north;

    /**
     * @return Point
     */
    public function getPoint(): Point
    {
        return $this->point;
    }

    /**
     * @param Point $point
     * @return Data
     */
    public function setPoint(Point $point): Data
    {
        $this->point = $point;

        return $this;
    }

    /**
     * @return Distance[]
     */
    public function getDistances(): array
    {
        return $this->distances;
    }

    /**
     * @param Distance[] $distances
     * @return Data
     */
    public function setDistances(array $distances): Data
    {
        $this->distances = $distances;

        return $this;
    }

    /**
     * @return string
     */
    public function getEast(): string
    {
        return $this->east;
    }

    /**
     * @param string $east
     * @return Data
     */
    public function setEast(string $east): Data
    {
        $this->east = $east;

        return $this;
    }

    /**
     * @return string
     */
    public function getWest(): string
    {
        return $this->west;
    }

    /**
     * @param string $west
     * @return Data
     */
    public function setWest(string $west): Data
    {
        $this->west = $west;

        return $this;
    }

    /**
     * @return string
     */
    public function getSouth(): string
    {
        return $this->south;
    }

    /**
     * @param string $south
     * @return Data
     */
    public function setSouth(string $south): Data
    {
        $this->south = $south;

        return $this;
    }

    /**
     * @return string
     */
    public function getNorth(): string
    {
        return $this->north;
    }

    /**
     * @param string $north
     * @return Data
     */
    public function setNorth(string $north): Data
    {
        $this->north = $north;

        return $this;
    }

    /**
     * @param array $data
     * @return Data
     */
    public function setLinks(array $data): Data
    {
        foreach (self::DIRECTIONS as $DIRECTION) {
            if (!in_array($DIRECTION, array_keys($data))) {
                throw new \RuntimeException('In array is lacking direction: '. $DIRECTION);
            }
        }

        $this
            ->setEast($data['east'])
            ->setWest($data['west'])
            ->setSouth($data['south'])
            ->setNorth($data['north'])
        ;

        return $this;
    }
}