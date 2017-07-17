<?php

namespace LIDAR\Data;

/**
 * Interface StackInterface
 * @package LIDAR\Data
 */
interface StackInterface
{
    /**
     * @param string $fileName
     */
    public function push(string $fileName): void;

    /**
     * @param string $fileName
     * @return bool
     */
    public function contain(string $fileName): bool;
}