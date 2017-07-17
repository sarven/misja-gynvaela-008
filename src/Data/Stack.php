<?php

namespace LIDAR\Data;

/**
 * Class Stack
 * @package LIDAR\Data
 */
final class Stack implements StackInterface
{
    /**
     * @var array
     */
    private $items;

    /**
     * Stack constructor.
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @param string $fileName
     */
    public function push(string $fileName): void
    {
        $this->items[] = $fileName;
    }

    /**
     * @param string $fileName
     * @return bool
     */
    public function contain(string $fileName): bool
    {
        return in_array($fileName, $this->items);
    }
}