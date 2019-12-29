<?php
class ParpReader implements ReaderInterface
{
    private $html;

    public function __construct(string $newsUrl)
    {
        $this->html = file_get_html($newsUrl);
    }

    public function getTitle(): String
    {
        foreach ($this->html->find('#article-title') as $articleTitle) {
            return $articleTitle->innertext;
        }
    }

    public function getContent(): String
    {
        foreach ($this->html->find('#article-content') as $articleContent) {
            return $articleContent->innertext;
        }
    }

    public function getDate(): String
    {
        foreach ($this->html->find('#article-date') as $articleDate) {
            return $articleDate->innertext;
        }
    }
}