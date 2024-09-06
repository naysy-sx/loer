<style>
    .alert-secondary {
        color: #383d41;
        background-color: #dea5ad;
        border-color: #d6d8db;
        width: 130px;
    }

    table {
        width: 100%;
    }

    td {
        border: 1px solid darkgrey;
        padding: 3px;
    }
</style>
<?php
$human_date_format = date('d.m.Y', strtotime($day));
?>
<?php
$cr_tasks = \app\models\db\Tasks::find()
    ->where(['user_id' => Yii::$app->user->id])
    ->andWhere(['datetime_end' => $day])
    ->asArray()
    ->all();

foreach ($cr_tasks as $count => $cr_task) {
    echo "<tr>";
    //        if ($count > 0) {
    //            echo "<hr style='border-top: 1px solid rgb(0 0 0 / 44%);'>";
    //        }

    echo "<td>";
    if (!$cr_task['status']) {
        echo "<input type='checkbox'  data-id='{$cr_task['id']}'>";
    } else {
        echo "<input type='checkbox'  checked='checked' data-id='{$cr_task['id']}'>";
    }
    echo "</td>";

    echo "<td><b>{$cr_task['title']}</b><br>{$cr_task['description']}</td>";
    echo "<td>".date('H:i', $cr_task['datetime'])."</td>";
    echo "<td>{$cr_task['client_id']}</td>";
    echo "<td></td>";
    echo "<td></td>";
}
?>