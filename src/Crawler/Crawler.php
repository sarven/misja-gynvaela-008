<?php

namespace LIDAR\Crawler;

use LIDAR\Console\OutputInterface;
use LIDAR\File\FileHandlerInterface;
use LIDAR\Parser\DataParserInterface;

/**
 * Class Crawler
 * @package LIDAR\Crawler
 */
final class Crawler implements CrawlerInterface
{
    const URL_PATTERN = 'http://gynvael.coldwind.pl/misja008_drone_io/scans/%s';
    const INITIAL_FILE = '68eb1a7625837e38d55c54dc99257a17.txt';

    /**
     * @var FileHandlerInterface
     */
    private $fileHandler;

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var DataParserInterface
     */
    private $dataParser;

    /**
     * Crawler constructor.
     * @param FileHandlerInterface $fileHandler
     * @param OutputInterface $output
     * @param DataParserInterface $dataParser
     */
    public function __construct(
        FileHandlerInterface $fileHandler,
        OutputInterface $output,
        DataParserInterface $dataParser
    )
    {
        $this->fileHandler = $fileHandler;
        $this->output = $output;
        $this->dataParser = $dataParser;
    }

    public function run(): void
    {
        $content = file_get_contents(sprintf(self::URL_PATTERN, self::INITIAL_FILE));
        $bytes = $this->fileHandler->save(self::INITIAL_FILE, $content);
        $this->output->writeLn("Saved $bytes B of data.");
        $data = $this->dataParser->parse($content);
    }
}