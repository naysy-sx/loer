<style>
    .alert-secondary {
        color: #383d41;
        background-color: #dea5ad;
        border-color: #d6d8db;
        width: 130px;
    }
</style>
<?php
$human_date_format = date('d.m.Y', strtotime($day));
?>
<div class="day-line">
    <div class="date"><?=$human_date_format?></div>
    <?php
    $cr_tasks = \app\models\db\Tasks::find()
        ->where(['user_id' => Yii::$app->user->id])
        ->andWhere(['datetime_end' => $day])
        ->asArray()
        ->all();

    foreach ($cr_tasks as $count => $cr_task) {
        if ($count > 0) {
            echo "<hr style='border-top: 1px solid rgb(0 0 0 / 44%);'>";
        }

        if (!$cr_task['status']) {
            echo "<div class='one-task'>";
            echo "<input type='checkbox' class='task-checkbox' data-id='{$cr_task['id']}'>";
        } else {
            echo "<div class='one-task task-complete'>";
            echo "<input type='checkbox' class='task-checkbox' checked='checked' data-id='{$cr_task['id']}'>";
        }

        echo "<div class='task-content'>";
        echo "<b> {$cr_task['title']}</b><br>";
        echo nl2br($cr_task['description']);
        echo "</div>";
        echo "</div>";
    }
    ?>
</div>