<?php
include('Importer.php');
include('simple_html_dom.php');
include('getters/SiteNewsGetterInterface.php');
include('getters/PARPNewsGetter.php');
include('getters/BiznesNewsGetter.php');
include('getters/GovNewsGetter.php');

//news list
$getter = new PARPNewsGetter();
$newsList['Parp'] = $getter->returnNewsUrlList();
$getter = new BiznesNewsGetter();
$newsList['Biznes'] = $getter->returnNewsUrlList();
$getter = new GovNewsGetter();
$newsList['Gov'] = $getter->returnNewsUrlList();

//import to DB
$currentUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if (isset($_GET['url'])) {
    $url = $_GET['url'];
    $importer = new Importer($url);
    header('Location: '.$currentUrl);
}