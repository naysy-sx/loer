<?php

namespace app\models;

use app\models\db\Clients;
use app\models\db\Crm;
use app\models\db\Tasks;

/**
 * Получение задач crm
 * @package app\models
 */
class CrmGetTasks
{
    /**
     * По статусу
     *
     * @param $status
     *
     * @return array
     */
    public static function byStatus($status): array
    {
        return Clients::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->andWhere(['status_position' => $status])
            ->asArray()
            ->all();
    }
}