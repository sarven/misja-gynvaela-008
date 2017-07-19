<?php

namespace LIDAR\Solver;

use LIDAR\Console\OutputInterface;
use LIDAR\Entity\Data;
use LIDAR\File\FileHandler;
use LIDAR\File\FileHandlerInterface;
use LIDAR\Map\DrawerInterface;
use LIDAR\Parser\DataParserInterface;

/**
 * Class Solver
 * @package LIDAR\Solver
 */
final class Solver implements SolverInterface
{
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
     * @var DrawerInterface
     */
    private $drawer;

    /**
     * Solver constructor.
     * @param FileHandlerInterface $fileHandler
     * @param OutputInterface $output
     * @param DataParserInterface $dataParser
     * @param DrawerInterface $drawer
     */
    public function __construct(
        FileHandlerInterface $fileHandler,
        OutputInterface $output,
        DataParserInterface $dataParser,
        DrawerInterface $drawer
    )
    {
        $this->fileHandler = $fileHandler;
        $this->output = $output;
        $this->dataParser = $dataParser;
        $this->drawer = $drawer;
    }

    public function solve(): void
    {
        $this->processFiles();
    }

    private function processFiles(): void
    {
        $fileIterator = FileHandler::createIterator();
        $count = FileHandler::getCount($fileIterator);
        $i = 1;

        foreach ($fileIterator as $file) {
            $data = $this->parseContent($file->getFileName());
            $this->drawer->draw($data);
            $this->output->writeLn($i.' of '.$count.' files processed.');
            $i++;
        }
    }

    /**
     * @param string $fileName
     * @return Data
     */
    private function parseContent(string $fileName): Data
    {
        $content = $this->fileHandler->read($fileName);

        return $this->dataParser->parse($content);
    }
}