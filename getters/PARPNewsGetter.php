<?php
class PARPNewsGetter implements SiteNewsGetterInterface
{
    private $siteUrl = 'https://www.parp.gov.pl';

    public function returnNewsUrlList(): Array
    {
        try {
            $html = file_get_html($this->siteUrl);
        } catch (Exception $e) {
            echo 'Nastąpił nieoczekiwany błąd. Spróbuj ponownie lub skontaktuj się z administratorem. <br>'.$e->getMessage();
        }

        $news = Array();
        $i = 0;
        foreach ($html->find('div.col-12.col-md-6.order-md-1 > div') as $element) {
            foreach ($element->find('a') as $a) {
                $news[$i]['url'] = $this->siteUrl . $a->href;
                foreach ($a->find('.mb-1.text-mm-16') as $title) {
                    $news[$i]['title'] = $title->innertext;
                }
                $i++;
            }
        }
        return $news;
    }
}