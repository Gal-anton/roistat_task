<?php

namespace Angalichin\RoistatTask\Test;

use Angalichin\RoistatTask\JsonReport;
use PHPUnit\Framework\TestCase;

class JsonReportTest extends TestCase
{
    public function testExceptionJson()
    {
        $this->expectExceptionMessage("The problem while creating json occurred");
        $statistic = [
            'url_count' => ['/chat.php' => 2],
            'invalidValue' => NAN
            ];
        $report = new JsonReport();
        $json = $report->createReport($statistic);
        var_dump($json);
    }

}
