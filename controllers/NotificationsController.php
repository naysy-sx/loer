<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\Calendar;
use app\models\db\Tasks;
use app\models\Notifications;
use Codeception\Lib\Notification;
use Yii;
use yii\web\Controller;
use \Datetime;

/**
 * Уведомления
 * @package app\controllers
 */

 class NotificationsController extends Controller{




     /**
     * Контроль доступа
     *
     * @param \yii\base\Action $action
     *
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */

     public function actionIndex()
     {
         return $this->render('index');
     }

     public function actionGetNotification(){
         $res = Notifications::find()->where(['user_id' =>Yii::$app->user->id])->orderBy(['id'=>SORT_DESC])->all();
        //  var_dump($res);
         $html = '';
         foreach ($res as $row) {
            $html.= '<div class="filter-result alert alert-warning">
            <div class="day-line">
                <div class="date">'.$row['datetime'].'</div>
                <div class="one-task">
                    <div class="task-content"><b>'.$row['title'].'</b></div>
                </div>
            </div>
        </div>';
         }
         return $html;
     }
    //  public static function actionAddNotification(){
    //     $title = htmlspecialchars($_GET['title']);
    //     $user_id =  Yii::$app->user->id;
    //     $t = time();
    //     $t = date('Y-m-d', $t);
    //     $data = new Notifications;
    //     $data->title = $title;
    //     $data->datetime = $t;
    //     $data->user_id = $user_id;
    //     return  $data->save();
    //  }




}