<?php


namespace Angalichin\RoistatTask;


interface ParserInterface
{
    /**
     * @param string $line
     * @return mixed
     * @throws \Exception
     */
    function parse(string $line): mixed;
}