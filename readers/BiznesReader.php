<?php
class BiznesReader implements ReaderInterface
{
    private $html;

    public function __construct(string $newsUrl)
    {
        try {
            $this->html = file_get_html($newsUrl);
        } catch (Exception $e) {
            echo 'Nastąpił nieoczekiwany błąd. Spróbuj ponownie lub skontaktuj się z administratorem. <br>'.$e->getMessage();
        }
    }

    public function getTitle(): String
    {
        foreach ($this->html->find('article.content-box h1.content-title') as $articleTitle) {
            return $articleTitle->innertext;
        }
    }

    public function getContent(): String
    {
        foreach ($this->html->find('article.content-box #insidecontent') as $articleContent) {
            return explode('<section class="opinion-box" id="opinionBox">', $articleContent->innertext)[0];
        }
    }

    public function getDate(): String
    {
        foreach ($this->html->find('.content-metrics.metrics > dl > dd') as $articleDate) {
            return $articleDate->innertext;
        }
    }
}