<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Documents</title>
        <link rel="stylesheet" type="text/css" href="./js/components/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="./js/components/datatables.net-dt/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/style.css"/>
        <link rel="stylesheet" href="./css/styles.css">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head() ?>
    </head>
    <body class="bg-img">
    <?php $this->beginBody() ?>
    <?=$this->render('_parts/_header');?>
    <main>
        <div class="index-container">
            <?=$this->render('_parts/_leftNav');?>
            <?=$content;?>
        </div>
    </main>
    <script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="./js/calendars.js"></script>
    <script src="./js/main.js"></script>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>