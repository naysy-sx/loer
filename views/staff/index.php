<?php

use app\models\Settings;
use app\models\User;

$this->title = Settings::getPageTitle('Мои сотрудники');
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
            <span class="index-window-panel-title text-gradient-light-red">Мои сотрудники</span>
        </div>
        <div class="col-md-3" style="text-align: right">
            <a href="index.php?r=staff/add">
                <button class="btn btn-success">Добавить</button>
            </a>
        </div>
    </div>

    <div class="col-md-12 nav-margin">
        <?php echo $this->render('//layouts/_parts/_company_nav'); ?>
    </div>

    <table>
        <tr>
            <th>Имя</th>
            <th>Статус</th>
            <th>Аналитика</th>
        </tr>
        <?php
        if (Yii::$app->user->identity->company_name == 'none'){
            $company = '';
        } else {
            $company = Yii::$app->user->identity->company_name;
        }

        $staffs = User::find()->where(['company_name' => $company])->asArray()->all();

        foreach ($staffs as $staff) {
            echo "<tr>";
            echo "<td><a href='index.php?r=staff/edit&id={$staff['id']}' style='color: black !important;'>{$staff['email']}</a></td>";

            if ($staff['status'] == 10) {
                echo "<td style='color: green'>Активен</td>";
            } else {
                echo "<td style='color: red'>Заблокирован</td>";
            }

            echo '<td><a href="index.php?r=staff/stats" class="link-iw">Просмотр</a></td>';

            echo "</tr>";
        }
        ?>
    </table>
</div>