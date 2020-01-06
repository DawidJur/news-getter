<?php
class GovReader implements ReaderInterface
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
        foreach ($this->html->find('.article-area.main-container > .article-area__article h2') as $articleTitle) {
            return $articleTitle->innertext;
        }
    }

    public function getContent(): String
    {
        $content = '';
        foreach ($this->html->find('.article-area.main-container > .article-area__article .intro') as $articleContent) {
            $content = $articleContent->innertext;
        }
        foreach ($this->html->find('.article-area.main-container > .article-area__article .editor-content > div') as $articleContent) {
            $content .= $articleContent->innertext;
        }

        return $content;
    }

    public function getDate(): String
    {
        foreach ($this->html->find('.article-area.main-container > .article-area__article .event-date') as $articleDate) {
            return $articleDate->innertext;
        }
    }
}