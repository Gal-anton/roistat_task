<?php

namespace Angalichin\RoistatTask;

interface StatisticInterface
{
    function add(string $info);

    function statistic();
}