<?php

namespace LIDAR\Crawler;

use LIDAR\Console\OutputInterface;
use LIDAR\Data\Queue;
use LIDAR\Data\Stack;
use LIDAR\Entity\Data;
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
     * @var int
     */
    private $downloadedFiles;

    /**
     * @var int
     */
    private $downloadedBytes;

    /**
     * @var Stack
     */
    private $done;

    /**
     * @var Queue
     */
    private $toDo;

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
        $this->downloadedBytes = 0;
        $this->downloadedFiles = 0;
        $this->done = new Stack();
        $this->toDo = new Queue();
    }

    public function run(): void
    {
        $data = $this->parseContent(self::INITIAL_FILE);
        $this->addDataToQueue($data);

        while (!$this->toDo->isEmpty()) {
            $data = $this->parseContent($this->toDo->get());
            $this->addDataToQueue($data);
        }

        $this->output->writeLn('Downloaded '.$this->downloadedFiles.' files / '.($this->downloadedBytes/1024).'KB.');
    }

    /**
     * @param string $fileName
     * @return Data
     */
    private function parseContent(string $fileName): Data
    {
        $content = false;

        while (!$content) {
            $content = file_get_contents(sprintf(self::URL_PATTERN, $fileName));
        }

        $bytes = $this->fileHandler->save($fileName, $content);
        $this->done->push($fileName);
        $this->downloadedFiles += 1;
        $this->downloadedBytes += $bytes;
        $this->output->writeLn('#'.$this->downloadedFiles.' Saved '.$bytes.' B of data.');

        return $this->dataParser->parse($content);
    }

    /**
     * @param Data $data
     */
    private function addDataToQueue(Data $data): void
    {
        if (static::isPossibleAddingToQueue($data->getEast())) {
            $this->toDo->enqueue($data->getEast());
        }

        if (static::isPossibleAddingToQueue($data->getWest())) {
            $this->toDo->enqueue($data->getWest());
        }

        if (static::isPossibleAddingToQueue($data->getSouth())) {
            $this->toDo->enqueue($data->getSouth());
        }

        if (static::isPossibleAddingToQueue($data->getNorth())) {
            $this->toDo->enqueue($data->getNorth());
        }
    }

    /**
     * @param string $fileName
     * @return bool
     */
    private function isPossibleAddingToQueue(string $fileName)
    {
        return $fileName !== Data::NOT_POSSIBLE
            && !$this->toDo->contain($fileName)
            && !$this->done->contain($fileName)
        ;
    }
}