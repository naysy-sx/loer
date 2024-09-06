<?php

use app\models\Settings;
use app\models\User;

$this->title = Settings::getPageTitle('Аналитика');
?>
<style>
    table {
        width: 100%;
    }

    td, th {
        border: 1px solid #e2e2e2;
        padding: 5px 10px;
    }
</style>
<div class="index-window">
    <div class="index-window-panel">
        <div class="col-md-9">
            <span class="index-window-panel-title text-gradient-light-red">Аналитика</span>
        </div>
    </div>

    <div class="col-md-12 nav-margin">
        <?php echo $this->render('//layouts/_parts/_company_nav'); ?>
    </div>

    По выбранному сотруднику выполненных действий не найдно.
    <br><br>
    <a href="index.php?r=staff" class="link-iw">Назад</a>

</div>