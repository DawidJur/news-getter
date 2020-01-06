<?php
class GovNewsGetter implements SiteNewsGetterInterface
{
    private $siteUrl = 'https://www.gov.pl';
    private $newsUrl = 'https://www.gov.pl/web/finanse/wiadomosci';

    public function returnNewsUrlList(): Array
    {
        try {
            $html = file_get_html($this->newsUrl);
        } catch (Exception $e) {
            echo 'Nastąpił nieoczekiwany błąd. Spróbuj ponownie lub skontaktuj się z administratorem. <br>'.$e->getMessage();
        }

        $news = Array();
        $i = 0;
        foreach ($html->find('article.article-area__article > div > ul') as $element) {
            foreach ($element->find('li > a') as $a) {
                $news[$i]['url'] = $this->siteUrl . $a->href;
                foreach ($a->find('.title') as $title) {
                    $news[$i]['title'] = $title->innertext;
                }
                $i++;
            }
        }
        return $news;
    }
}