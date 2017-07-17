<?php

namespace LIDAR\Data;

/**
 * Interface QueueInterface
 * @package LIDAR\Data
 */
interface QueueInterface
{
    /**
     * @return string
     */
    public function get(): string;

    /**
     * @param string $fileName
     */
    public function enqueue(string $fileName): void;

    /**
     * @param string $fileName
     */
    public function dequeue(string $fileName): void;

    /**
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * @param string $fileName
     * @return bool
     */
    public function contain(string $fileName): bool;
}