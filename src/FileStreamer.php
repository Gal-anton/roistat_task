<?php


namespace Angalichin\RoistatTask;


/**
 * Class FileStreamer
 * @package Angalichin\RoistatTask
 */
class FileStreamer implements StreamerInterface
{
    /**
     * @var resource
     */
    private $file;

    /**
     * FileStreamer constructor.
     * @param string $filePath
     * @throws \Exception
     */
    public function __construct(string $filePath)
    {
        if (!is_readable($filePath)) {
            throw new \Exception('File is not readable or it does not exist');
        }

        $this->file = fopen($filePath, 'r');
        if (!$this->file) {
            throw new \Exception('The problem while opening file occurred');
        }

    }

    /**
     * @return \Generator
     * @throws \Exception
     */
    public function streamLines(): \Generator
    {
        while (!feof($this->file)) {
            $line = fgets($this->file);
            if ($line) {
                yield trim($line);
            }
        }
    }

    /**
     * FileStreamer destructor.
     */
    public function __destruct()
    {
        fclose($this->file);
    }
}