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

    /**
     * @param string $name
     * @return string
     */
    public function read(string $name): string;

    /**
     * @return \FilesystemIterator
     */
    public static function createIterator(): \FilesystemIterator;

    /**
     * @param \FilesystemIterator $filesystemIterator
     * @return int
     */
    public static function getCount(\FilesystemIterator $filesystemIterator): int;
}