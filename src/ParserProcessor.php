<?php

namespace Angalichin\RoistatTask;

/**
 * Class ParserProcessor
 * @package Angalichin\RoistatTask
 */
class ParserProcessor
{
    /**
     * @var StreamerInterface
     */
    private StreamerInterface $streamer;

    /**
     * @var StatisticInterface
     */
    private StatisticInterface $statistic;

    /**
     * ParserProcessor constructor.
     * @param StreamerInterface|null $streamer
     * @throws \Exception
     */
    public function __construct(?StreamerInterface $streamer)
    {
        if (is_null($streamer)) {
            throw new \Exception('The streamer cannot be null');
        }
        $this->streamer = $streamer;
    }

    /**
     * @param StatisticInterface|null $statistic
     */
    public function parseStream(?StatisticInterface $statistic = null)
    {
        $this->statistic = $statistic ?? new AccessLogStatistic();

        foreach ($this->streamer->streamLines() as $streamLine) {
            $this->statistic->add($streamLine);
        }
    }

    /**
     * @param ReportInterface $report
     * @return mixed
     */
    public function report(ReportInterface $report): mixed
    {
        return $report->createReport($this->statistic->statistic());
    }

}