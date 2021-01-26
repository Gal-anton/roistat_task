<?php

use Angalichin\RoistatTask\FileStreamer;
use Angalichin\RoistatTask\JsonReport;
use Angalichin\RoistatTask\ParserProcessor;

require_once "vendor/autoload.php";

try {
    if (count($argv) <= 1) {
        throw new \Exception("The file path must be specified");
    }

    $fileStreamer = new FileStreamer($argv[1]);
    $parser = new ParserProcessor($fileStreamer);
    $parser->parseStream();
    $report = $parser->report(new JsonReport());
} catch (Exception $e) {
    die($e->getMessage());
}

print_r($report);