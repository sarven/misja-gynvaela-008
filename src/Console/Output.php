<?php

namespace LIDAR\Console;

/**
 * Class Output
 * @package LIDAR\Console
 */
final class Output implements OutputInterface
{
    /**
     * {@inheritdoc}
     */
    public function write(string $text): void
    {
        echo $text;
    }

    /**
     * {@inheritdoc}
     */
    public function writeLn(string $text): void
    {
        echo $text.PHP_EOL;
    }
}