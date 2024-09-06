<?php

use app\models\Settings;

$this->title = Settings::getPageTitle('Редактирование сотрудника');
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
            <span class="index-window-panel-title text-gradient-light-red">Редактирование сотрудника</span>
        </div>
        <div class="col-md-3" style="text-align: right">
            <a href="index.php?r=staff">
                <button class="btn btn-danger">Отменить</button>
            </a>
        </div>
    </div>
    <div class="nav-margin">
        <?php echo $this->render('//layouts/_parts/_company_nav'); ?>
    </div>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>
</div>