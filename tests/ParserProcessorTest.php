<?php

namespace Angalichin\RoistatTask\Test;

use Angalichin\RoistatTask\FileStreamer;
use Angalichin\RoistatTask\JsonReport;
use Angalichin\RoistatTask\ParserProcessor;
use PHPUnit\Framework\TestCase;


/**
 * Class ParserProcessorTest
 * @package Angalichin\RoistatTask\Test
 */
class ParserProcessorTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testParse()
    {
        $streamer = $this->getMockBuilder(FileStreamer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $streamer->method("streamLines")
            ->willReturn($this->sampleData());

        $parser = new ParserProcessor($streamer);
        $parser->parseStream();

        $expect = "{\n" .
            "    \"view\": 3,\n" .
            "    \"url_count\": 2,\n" .
            "    \"traffic\": 46976,\n" .
            "    \"crawlers\": {\n" .
            "        \"Google\": 1,\n" .
            "        \"Bing\": 0,\n" .
            "        \"Baidu\": 0,\n" .
            "        \"Yandex\": 0\n" .
            "    },\n" .
            "    \"statusCode\": {\n" .
            "        \"200\": 3\n" .
            "    }\n" .
            "}";

        $this->assertEquals($expect, $parser->report(new JsonReport()));

    }

    /**
     * @throws \Exception
     */
    public function testConstructionWithException()
    {

        $this->expectExceptionMessage('The streamer cannot be null');
        $streamer = null;
        new ParserProcessor($streamer);
    }

    /**
     * @return \Generator
     */
    function sampleData(): \Generator
    {
        $sampleData = [
            '84.242.208.111 - - [11/May/2013:06:31:00 +0200] "POST ' .
            '/chat.php HTTP/1.1" 200 354 "http://bim-bom.ru/" ' .
            '"Mozilla/5.0 (Windows NT 6.1; rv:20.0) Gecko/20100101 Firefox/20.0"',
            '77.21.132.156 - - [24/May/2013:23:38:23 +0200] "POST ' .
            '/app/engine/api.php HTTP/1.1" 200 46542 ' .
            '"http://lag.ru/index.php" "Mozilla/5.0 (Windows NT 6.1; WOW64) ' .
            'AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31"',
            '77.21.132.156 - - [24/May/2013:23:38:03 +0200] "POST /app/engine/api.php ' .
            'HTTP/1.1" 200 80 "http://lag.ru/index.php" "Mozilla/5.0 (Windows NT 6.1; ' .
            'WOW64) Googlebot/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 ' .
            'Safari/537.31"'
        ];
        foreach ($sampleData as $sample) {
            yield $sample;
        }
    }
}
