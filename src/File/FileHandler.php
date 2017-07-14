<?php

namespace LIDAR\File;

/**
 * Class FileHandler
 * @package LIDAR\File
 */
final class FileHandler implements FileHandlerInterface
{
    const DATA_DIR = '/../../data/';

    /**
     * {@inheritdoc}
     */
    public function save(string $name, string $content): int
    {
        try {
            $handle = static::createFile($name, 'c');
            $bytes = static::write($handle, $content);
            static::closeFile($handle);

            return $bytes;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param string $name
     * @param string $mode
     * @return resource
     */
    private static function createFile(string $name, string $mode)
    {
        $handle = fopen(__DIR__.self::DATA_DIR.$name, $mode);

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