<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<?php if ($this->title == 'Not Found (#404)') { ?>
    <div class="site-error">
        <h1>Доступ закрыт</h1>
        <div class="alert alert-danger">
            Данная страница находится в разработке или на нее ограничены права
        </div>
    </div>
<?php } else { ?>
    <div class="site-error">
        <h1><?=Html::encode($this->title)?></h1>
        <div class="alert alert-danger">
            <?=nl2br(Html::encode($message))?>
        </div>
    </div>
<?php }