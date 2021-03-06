<?php

namespace Angalichin\RoistatTask;

/**
 * Class AccessLogParser
 * @package Angalichin\RoistatTask
 */
class AccessLogParser implements ParserInterface
{
    /**
     * @param string $line
     * @return array
     */
    public function parse(string $line): array
    {
        $charsToDelete = str_split('")(;][');
        $lineFormatted = str_replace($charsToDelete, '', $line);

        return explode(' ', $lineFormatted);
    }
}