<?php

namespace app\controllers;

use app\models\db\Crm;
use app\models\db\Tasks;
use Yii;
use yii\web\Controller;
use app\models\Notifications;

/**
 * CRM
 * @package app\controllers
 */
class CrmController extends Controller
{
    public $layout = 'crm';

    /**
     * Обзор всех
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Добавление
     *
     * @return string
     */
    public function actionAdd()
    {
        $model = new Crm;

        if ($model->load(Yii::$app->request->post())) {
            $model->datetime = time();
            $model->deadline = strtotime($model->deadline);
            $model->save();

            // если указано название задачи = создаем новую задачу
            if (mb_strlen($model->task) > 0) {
                if (mb_strlen($model->comment) < 1) {
                    $model->comment = 'Задача, созданная из CRM';
                }

                $new_task               = new Tasks;
                $new_task->user_id      = $model->worker;
                $new_task->client_id    = 0;
                $new_task->order_id     = 0;
                $new_task->datetime     = date('Y-m-d');
                $new_task->datetime_end = date('Y-m-d', $model->deadline);
                $new_task->title        = $model->task;
                $new_task->description  = $model->comment;
                $new_task->status       = 1;
                $new_task->day          = date('d', $model->deadline);
                $new_task->month        = date('m', $model->deadline);
                $new_task->year         = date('Y', $model->deadline);

                $new_task->save();

                //    уведомление создаем
                $user_id =  Yii::$app->user->id;
                $t = time();
                $t = date('Y-m-d', $t);
                $data = new Notifications;
                $data->title = "Новый Лид";
                $data->datetime = $t;
                $data->user_id = $user_id;
                $data->save();
            }

            return $this->redirect(['index']);
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    /**
     * [ajax] Смена статуса задачи
     *
     * @return bool
     */
    public function actionAjaxChangeStatus()
    {
        $id                  = htmlspecialchars($_GET['id']);
        $new_status          = htmlspecialchars($_GET['new_status']);
        $cr_crm_task         = Crm::find()->where(['id' => $id])->one();
        $cr_crm_task->status = $new_status;
        $cr_crm_task->save();

        return true;
    }
}