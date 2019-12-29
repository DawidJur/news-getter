<?php
class GovNewsGetter implements SiteNewsGetterInterface
{
    private $siteUrl = 'https://www.gov.pl';
    private $newsUrl = 'https://www.gov.pl/web/rozwoj/wiadomosci';

    public function returnNewsUrlList(): Array
    {
        $html = file_get_html($this->newsUrl);
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