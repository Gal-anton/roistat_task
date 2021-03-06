<?php

namespace Angalichin\RoistatTask;

/**
 * Class AccessLogStatistic
 * @package Angalichin\RoistatTask
 */
class AccessLogStatistic implements StatisticInterface
{
    /**
     * @var AccessLogParser
     */
    private AccessLogParser $parser;

    /**
     * @var array
     */
    private array $statistic;

    /**
     * @var array
     */
    private array $crawlers = [
        'Google',
        'Bing',
        'Baidu',
        'Yandex'
    ];

    /**
     * @var array
     */
    private array $trafficIgnoreStatusCode = [
        '301',
    ];

    /**
     * AccessLogStatistic constructor.
     */
    public function __construct()
    {
        $this->parser = new AccessLogParser();
        $this->statistic = [
            'view' => 0,
            'url_count' => [],
            'traffic' => 0,
            'crawlers' => [],
            'statusCode' => [],
        ];
        foreach ($this->crawlers as $existedCrawler) {
            $this->statistic['crawlers'][$existedCrawler] = 0;
        }

    }

    /**
     * @param string $info
     */
    public function add(string $info)
    {
        $logInfo = $this->parser->parse($info);
        $url = $logInfo[6];
        $traffic = (int)$logInfo[9];
        $crawler = $logInfo[16];
        $statusCode = $logInfo[8];
        $this->addView();
        $this->addUrl($url);
        $this->addStatusCode($statusCode);
        if (!in_array($statusCode, $this->trafficIgnoreStatusCode)) {
            $this->addTraffic($traffic);
        }
        $this->addCrawler($crawler);
    }

    /**
     * @return array
     */
    public function statistic(): array
    {
        return $this->statistic;
    }


    private function addView()
    {
        $this->statistic['view']++;
    }

    /**
     * @param string $url
     */
    private function addUrl(string $url)
    {
        if (!array_key_exists($url, $this->statistic['url_count'])) {
            $this->statistic['url_count'][$url] = 1;
        } else {
            $this->statistic['url_count'][$url]++;
        }
    }

    /**
     * @param string $statusCode
     */
    private function addStatusCode(string $statusCode)
    {
        if (!array_key_exists($statusCode, $this->statistic['statusCode'])) {
            $this->statistic['statusCode'][$statusCode] = 1;
        } else {
            $this->statistic['statusCode'][$statusCode]++;
        }
    }

    /**
     * @param int $traffic
     */
    private function addTraffic(int $traffic)
    {
        $this->statistic['traffic'] += $traffic;
    }

    /**
     * @param string $crawler
     */
    private function addCrawler(string $crawler)
    {
        foreach ($this->crawlers as $existedCrawler) {
            if (str_contains($crawler, $existedCrawler)) {
                $this->statistic['crawlers'][$existedCrawler]++;
            }
        }
    }

}