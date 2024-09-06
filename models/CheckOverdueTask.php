<?php

namespace app\models;

use app\models\db\Tasks;
use Yii;

/**
 * Модель проверки просроченных задач
 * (переносит старые задачи на сегодня)
 *
 * @package app\models
 */
class CheckOverdueTask
{
    public static function start()
    {
        $current_morning = strtotime(date('d.m.Y'));

        $tmp_tasks = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['<', 'datetime', $current_morning])
            ->asArray()
            ->all();

        foreach ($tmp_tasks as $tmp_task){
            /** @var Tasks $obj_task */
            $obj_task = Tasks::find()->where(['id' => $tmp_task['id']])->one();
            $obj_task->datetime = $current_morning;
            $obj_task->datetime_end = date('Y-m-d', $current_morning);;
            $obj_task->day = date('d', $current_morning);
            $obj_task->month = date('m', $current_morning);
            $obj_task->year = date('Y', $current_morning);
            $obj_task->overdue = 1;
            $obj_task->save();
        }
    }
}