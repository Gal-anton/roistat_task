<?php

namespace Angalichin\RoistatTask;

/**
 * Class JsonReport
 * @package Angalichin\RoistatTask
 */
class JsonReport implements ReportInterface
{

    /**
     * @param array $statistic
     * @return string
     * @throws \Exception
     */
    public function createReport(array $statistic): string
    {
        $preparedData = $this->prepareData($statistic);
        $result = json_encode($preparedData, JSON_PRETTY_PRINT);
        if (!$result) {
            throw new \Exception('The problem while creating json occurred');
        }

        return $result;
    }

    private function prepareData(array $data)
    {
        $preparedData = $data;
        $preparedData['url_count'] = count($data['url_count']);

        return $preparedData;
    }
}