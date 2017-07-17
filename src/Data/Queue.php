<?php

namespace LIDAR\Data;

/**
 * Class Queue
 * @package LIDAR\Data
 */
final class Queue implements QueueInterface
{
    /**
     * @var string[]
     */
    private $items;

    /**
     * Queue constructor.
     */
    public function __construct()
    {
        $this->items = [];
    }

    /**
     * @return string
     */
    public function get(): string
    {
        if ($this->isEmpty()) {
            throw new \RuntimeException('Queue is empty.');
        }

        return array_shift($this->items);
    }

    /**
     * @param string $fileName
     */
    public function enqueue(string $fileName): void
    {
        $this->items[] = $fileName;
    }

    /**
     * @param string $fileName
     */
    public function dequeue(string $fileName): void
    {
        if ($key = array_search($fileName, $this->items)) {
            unset($this->items[$key]);
        }
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
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