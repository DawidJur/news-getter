<?php
include('readers/ReaderInterface.php');
include('readers/ParpReader.php');
include('readers/GovReader.php');
include('readers/BiznesReader.php');
include('../wp-config.php');

class Importer
{
    private $mysqli;
    private $categoryId = 5; //id aktualności

    public function __construct(string $newsUrl)
    {
        $this->mysqli = $this->connectToDb();
        $this->addNews($newsUrl);
        $this->mysqli->close();
    }

    private function addNews(string $newsUrl): void
    {
        $reader = $this->getReader($newsUrl);
        $title = $reader->getTitle();
        $content = $reader->getContent();

        $this->addNewsToDatabase($title, $content);
        $this->addNewsToCategory();
    }

    private function getReader(string $newsUrl): ?ReaderInterface
    {
        $domain = parse_url($newsUrl)['host'];
        switch ($domain) {
            case 'www.parp.gov.pl':
                return new ParpReader($newsUrl);
            case 'www.gov.pl':
                return new GovReader($newsUrl);
            case 'www.biznes.gov.pl':
                return new BiznesReader($newsUrl);
            default:
                return null;
        }
    }

    private function addNewsToDatabase(string $title, string $content): void
    {
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO wp_posts VALUES ('', 1, ?, ?, ?, ?, '', 'draft', 'closed', 'closed', '', '', '', '', ?, ?, '', 0, '', 0, 'post', '', 0);";
        $query = $this->mysqli->prepare($sql);
        $query->bind_param('ssssss', $date, $date, $content, $title, $date, $date);
        $query->execute();
        $query->close();
    }

    private function connectToDb(): mysqli
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        $mysqli->set_charset("utf8");
        return $mysqli;
    }

    private function returnAddedNewsId(): int
    {
        return $this->mysqli->insert_id;
    }

    private function addNewsToCategory(): void
    {
        $newsId = $this->returnAddedNewsId();
        $sql = "INSERT INTO wp_term_relationships VALUES (?, ?, 0);";
        $query = $this->mysqli->prepare($sql);
        $query->bind_param('ss', $newsId, $this->categoryId);
        $query->execute();
    }
}