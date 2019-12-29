<?php
interface ReaderInterface
{
    public function __construct(string $newsUrl);

    function getTitle(): String;
    function getContent(): String;
    function getDate(): String;
}