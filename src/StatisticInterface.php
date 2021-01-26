<?php


namespace Angalichin\RoistatTask;


interface StatisticInterface
{
    function add(string $line);
    function statistic();
}