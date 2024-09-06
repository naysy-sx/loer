<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./js/components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./js/components/datatables.net-dt/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./css/styles.css">
    <!-- graph -->
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
    <link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
    <script src="https://cdn.anychart.com/releases/v8/themes/light_earth.min.js"></script>
    <!-- graph end -->
    <!-- calendar -->
    <script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js
"></script>
    <!-- end calendar -->

    <!-- bootstrap  -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
    <!-- end bootstrap  -->



    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="bg-img">
    <?php $this->beginBody() ?>
    <?= $this->render('_parts/_header'); ?>
    <main>
        <div class="index-container">
            <?= $this->render('_parts/_leftNav'); ?>
            <div class="index-window">
                <?= $content; ?>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="./js/main.js"></script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>