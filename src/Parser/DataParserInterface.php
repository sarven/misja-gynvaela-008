<?php

namespace LIDAR\Parser;

use LIDAR\Entity\Data;

/**
 * Interface DataParserInterface
 * @package LIDAR\Parser
 */
interface DataParserInterface
{
    public function parse(string $content): Data;
}