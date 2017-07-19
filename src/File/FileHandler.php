<?php

namespace LIDAR\File;

/**
 * Class FileHandler
 * @package LIDAR\File
 */
final class FileHandler implements FileHandlerInterface
{
    const DATA_DIR = __DIR__.'/../../data/';

    /**
     * {@inheritdoc}
     */
    public function save(string $name, string $content): int
    {
        $handle = static::createFile($name, 'x');
        $bytes = static::write($handle, $content);
        static::closeFile($handle);

        return $bytes;

    }

    /**
     * @param string $name
     * @return string
     */
    public function read(string $name): string
    {
        $content = file_get_contents(self::DATA_DIR.$name);

        if (!$content) {
            throw new \RuntimeException('Cannot open file: '.$name);
        }

        return $content;
    }

    /**
     * @return \FilesystemIterator
     */
    public static function createIterator(): \FilesystemIterator
    {
        return new \FilesystemIterator(self::DATA_DIR, \FilesystemIterator::SKIP_DOTS);
    }

    /**
     * @param \FilesystemIterator $filesystemIterator
     * @return int
     */
    public static function getCount(\FilesystemIterator $filesystemIterator): int
    {
        return iterator_count($filesystemIterator);
    }

    /**
     * @param string $name
     * @param string $mode
     * @return resource
     */
    private static function createFile(string $name, string $mode)
    {
        $handle = fopen(self::DATA_DIR.$name, $mode);

        if (!$handle) {
            throw new \RuntimeException('Cannot create file.');
        }

        return $handle;
    }

    /**
     * @param resource $handle
     * @param string $data
     * @return int
     */
    private static function write($handle, string $data): int
    {
        $bytes = fwrite($handle, $data);

        if (!$bytes) {
            throw new \RuntimeException('Cannot write to file.');
        }

        return $bytes;
    }

    /**
     * @param resource $handle
     */
    private static function closeFile($handle): void
    {
        fclose($handle);
    }
}