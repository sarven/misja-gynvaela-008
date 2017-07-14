<?php

namespace LIDAR\Console;

/**
 * Interface OutputInterface
 * @package LIDAR\Console
 */
interface OutputInterface
{
    /**
     * @param string $text
     */
    public function write(string $text): void;

    /**
     * @param string $text
     */
    public function writeLn(string $text): void;
}