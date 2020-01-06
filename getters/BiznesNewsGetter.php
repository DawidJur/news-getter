<?php


class BiznesNewsGetter implements SiteNewsGetterInterface
{
    private $siteUrl = 'https://www.biznes.gov.pl/pl';

    public function returnNewsUrlList(): Array
    {
        $html = file_get_html($this->siteUrl);
        $news = Array();

        $i = 0;
        foreach ($html->find('.row > .col-md-6.col-sm-6.col-xs-12 > ul') as $element) {
            //Library does not allow me to use nth-child, when I need to get 2nd child of container
            if ($i++ === 0) {
                continue;
            }
            foreach ($element->find('a') as $a) {
                $news[$i]['url'] = $a->href;
                $news[$i]['title'] = $a->innertext;
                $i++;
            }
        }

        return $news;
    }
}