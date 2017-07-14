<?php

namespace LIDAR\File;

/**
 * Interface FileHandlerInterface
 * @package LIDAR\File
 */
interface FileHandlerInterface
{
    /**
     * @param string $name
     * @param string $content
     * @return int
     */
    public function save(string $name, string $content): int;
}