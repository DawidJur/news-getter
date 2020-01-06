<?php include('logic.php'); ?>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<section class="jumbotron container">
    <?php
        foreach ($newsList as $site => $newsEach) {
            ?>
            <h3><?=$site;?></h3>
            <?php
            foreach($newsEach as $news) {
                ?>
                <div class="row mb-2 p-1 border border-primary">
                    <span class="col-8">
                        <?= $news['title']; ?>
                    </span>
                    <span class="col-4">
                        <a href="<?= $news['url']; ?>" class="btn btn-info ">
                            Zobacz news
                        </a>
                        <a href="<?= $currentUrl; ?>?url=<?= $news['url']; ?>" class="btn btn-success text-right">
                            Dodaj news jako szkic
                        </a>
                    </span>
                </div>
                <?php
            }
        }
    ?>
</section>
</body>
</html>
