<?php

namespace Angalichin\RoistatTask\Test;

use Angalichin\RoistatTask\FileStreamer;
use PHPUnit\Framework\TestCase;

/**
 * Class FileStreamerTest
 * @package Angalichin\RoistatTask\Test
 */
class FileStreamerTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testOpenedFile()
    {
        $fileStreamer = new FileStreamer(__DIR__ . '\access_log_test.txt');
        $this->assertObjectHasAttribute('file', $fileStreamer);
    }

    /**
     *
     */
    public function testFileIsNotReadable() {
        $this->expectExceptionMessage('File is not readable or it does not exist');
        new FileStreamer('access_log_test_nan.txt');
    }

    /**
     * @throws \Exception
     */
    public function testStreamLines() {
        $expectedLines = [];
        foreach (file(__DIR__ . '\access_log_test.txt')
                    as $line) {
            $expectedLines[] = trim($line);
        };

        $fileStreamer = new FileStreamer(__DIR__ . '\access_log_test.txt');
        $lines = [];
        foreach ($fileStreamer->streamLines() as $line) {
            $lines[] = $line;
        }
        $this->assertEquals($expectedLines, $lines);
    }
}
