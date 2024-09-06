<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\db\Tasks;
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{
    public $layout = 'tasks-all';

    /**
     * Контроль доступа
     *
     * @param \yii\base\Action $action
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        MainAccess::ifGuestGoHome();

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Обработка мнопки "Показать еще задачи"
     *
     * @return string
     */
    public function actionAjaxGetMoreTasks()
    {
        $this->layout = false;
        $task_by_days = [];
        $result = '';

        $all_tasks = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['datetime' => SORT_ASC])
            ->asArray()
            ->all();


        // группируем по дате
        foreach ($all_tasks as $data) {
            $task_by_days[$data['datetime_end']] = $data;
        }


        $human_date_format = date('d.m.Y', strtotime($data['datetime_end']));

        echo '<h4>' . $human_date_format . '</h4>';



        echo <<<HTML
        <table class="table-sort table-arrows classes-tables">
          <thead>
            <tr>
              <th>Статус</th>
              <th>Наименование</th>
              <th>Время</th>
              <th>Дело</th>
              <th>Ответственный</th>
              <th class="order-by-desc">Постановщик</th>
            </tr>
          </thead>
          <tbody>
        HTML;

        foreach ($task_by_days as $day => $task) {
            $result .= $this->render('../calendar/_dayTableLine', [
                'day' => $day,
            ]);
        }

        return $result;
    }

    public function actionSortTasks()
    {
        $name = htmlspecialchars($_GET['name']);

        $all_tasks = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['datetime' => SORT_ASC])
            ->asArray()
            ->all();
    }
}