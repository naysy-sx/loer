<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\Calendar;
use app\models\db\Tasks;
use app\models\Notifications;
use app\models\User;
use Yii;
use yii\web\Controller;

/**
 * Календарь
 * @package app\controllers
 */
class CalendarController extends Controller
{
    public $layout = 'calendar';

    /**
     * Контроль доступа
     *
     * @param \yii\base\Action $action
     *
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        MainAccess::ifGuestGoHome();

        return parent::beforeAction($action);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * [ajax] Добавление задачи
     *
     * @return bool
     */
    public function actionAddTask()
    {
        $title       = htmlspecialchars($_GET['tasktitle']);
        $description = htmlspecialchars($_GET['taskdescription']);
        $user        = htmlspecialchars($_GET['userid']);
        $date        = htmlspecialchars($_GET['taskdate']);
        $client_id   = htmlspecialchars($_GET['client_id']);
        $lead_id     = htmlspecialchars($_GET['lead_id']);
        $time        = htmlspecialchars($_GET['tasktime']);

        if (empty($client_id) or $client_id == 0) {
            $client_id = $lead_id;
        }

        $date     = strtotime($date);
        $date_end = date('Y-m-d', $date);

        if (empty($description)){
            $description = $title;
        }

        $task               = new Tasks;
        $task->user_id      = $user;
        $task->creator_id   = Yii::$app->user->id;
        $task->client_id    = $client_id;
        $task->order_id     = 0;
        $task->datetime     = $date;
        $task->datetime_end = $date_end;
        $task->title        = $title;
        $task->description  = $description;
        $task->status       = 0;
        $task->day          = date('d', $date);
        $task->month        = date('m', $date);
        $task->year         = date('Y', $date);
        $task->time         = $time;
        $task->save();

        echo '<pre>';
        var_dump($task);

        // создаем уведомление
        $user_id        = Yii::$app->user->id;
        $t              = time();
        $t              = date('Y-m-d', $t);
        $data           = new Notifications;
        $data->title    = "Новая задача";
        $data->datetime = $t;
        $data->user_id  = $user_id;
        $data->save();

        return true;
    }

    /**
     * [ajax] Поиск задач
     *
     * @return string
     */
    public function actionAjaxSearchTask()
    {
        $title  = htmlspecialchars($_GET['title']);
        $date   = htmlspecialchars($_GET['date']);
        $client = htmlspecialchars($_GET['client']);
        //$tasks   = Calendar::getTaskArr('', $month, '', '', $request);
        $tasks =
            Tasks::find()->where([
                'like',
                'title',
                $title,
            ])
                ->andFilterWhere(['client_id' => $client])
                ->asArray()
                ->all();
        $html  = '';

        foreach ($tasks as $task) {
            $time          = strtotime("{$task['day']}.{$task['month']}.{$task['year']}");
            $date          = date('d.m.Y', $time);
            $checked       = '';
            $text_red      = '';
            $alert         = '';
            $task_complete = ' ';
            $expired       = '';
            $html          .= '<div class="day-line">';
            $html          .= '<div class="date">';
            $html          .= date('d.m.Y', $task['datetime']);
            $html          .= '</div>';

            if (!$task['status']) {
                $html .= "<div class='one-task'>";
                $html .= "<input type='checkbox' class='task-checkbox' data-id='{$task['id']}'>";
            } else {
                $html .= "<div class='one-task task-complete'>";
                $html .= "<input type='checkbox' class='task-checkbox' checked='checked' data-id='{$task['id']}'>";
            }

            $html .= "<div class='task-content'>";
            $html .= "<b> {$task['title']}</b><br>";
            $html .= nl2br($task['description']);
            $html .= "</div>";
            $html .= "</div>";

            $html .= "</div>";

            // ебалистика
            //            if (!$task['status']) {
            //                $text_red = 'text-danger';
            //                $alert    = 'alert alert-secondary';
            //                $expired  = 'Просрочена с ';
            //            }
            //            if ((int)$task['status']) {
            //                $task_complete = ' task-complete ';
            //                $checked       = 'checked';
            //                $expired       = '';
            //            }
            //            if (!(int)$task['status'] && $time > time()) {
            //                $checked  = '';
            //                $text_red = '';
            //                $alert    = 'alert alert-primary';
            //                $expired  = '';
            //            }
            //
            //            if (!(int)$task['status'] && $time < time()) {
            //                $text_red = 'text-danger';
            //                $alert    = 'alert alert-secondary';
            //                $expired  = 'Просрочена с ';
            //                $checked  = '';
            //            }
            //
            //            $time = explode(":", $task['time']);
            //            $html .= '<div class="card my-3 one-task  ' . $task_complete . ' " data-main-' . $task['id'] . '>
            //                         <div class="card-header ' . $alert . '">
            //                           ' . $expired . $date . '
            //                            </div>
            //                            <div class="card-body row   ' . $task_complete . ' ' . $text_red . '">
            //                            <input type="checkbox" ' . $checked . '  class="task-checkbox col-1" data-id=' .
            //                $task['id'] . '>
            //                            <div class="blockquote mb-0 col-5" >
            //
            //                            <p class="h4" contenteditable="true" data-title-' . $task['id'] . '>' . $task['title'] . ' </p>
            //                            <p class="h6" contenteditable="true" data-description-' . $task['id'] . ' >' .
            //                $task['description'] . '</p>
            //                             <a href="/index.php?r=clients&client_id=' . $task['client_id'] . '">&#128279;</a>
            //                            </div>
            //                            <div class="blockquote mb-0 col-1" >
            //                            <input type="time" value="' . $time[0] . ':' . $time[1] . '"  data-time-' . $task['id'] . '/>
            //
            //                            </div>
            //                            <div class="blockquote mb-0 col-2" >
            //                            ' . Yii::$app->user->identity->username . '
            //                            ' . Yii::$app->user->identity->family . '
            //                              </div>
            //                              <div class="blockquote mb-0 col-2" >
            //                             ' . Yii::$app->user->identity->username . '
            //                             ' . Yii::$app->user->identity->family . '
            //                              </div>
            //                            <div class="blockquote mb-0 col-1">
            //                            <span type="button" class="p-2 action_icons" onclick="changeTask(' . $task['id'] . ')" >✎</span>
            //                            <span type="button" class="p-2 action_icons btn_delete" onclick="deleteTask(' .
            //                $task['id'] . ')">✖</span>
            //                            </div>
            //                            </div>
            //                    </div>';
        }

        return $html;
    }

    /**
     * [ajax] Подгрузка календаря за определенный месяц
     *
     * @return string
     */
    public function actionAjaxGetMonth()
    {
        $month = htmlspecialchars($_GET['month']);

        $task_dates = Tasks::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

        foreach ($task_dates as $task_date) {
            $day_month          = date('d.m', strtotime($task_date['datetime_end']));
            $events[$day_month] = $task_date['title'];
        }

        return Calendar::getInterval(date("{$month}.Y"), date("{$month}.Y"), $events);
    }

    /**
     * [ajax] Подгрузка календаря за определенный месяц + год
     *
     * @return string
     */
    public function actionAjaxGetMonthAndYear()
    {
        $month = htmlspecialchars($_GET['month']);
        $year  = htmlspecialchars($_GET['year']);

        $task_dates = Tasks::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

        foreach ($task_dates as $task_date) {
            $day_month          = date('d.m', strtotime($task_date['datetime_end']));
            $events[$day_month] = $task_date['title'];
        }

        return Calendar::getInterval(date("{$month}.{$year}"), date("{$month}.{$year}"), $events);
    }

    /**
     * @return bool
     */
    public function actionTaskComplete()
    {
        $id           = htmlspecialchars($_GET['id']);
        $status       = htmlspecialchars($_GET['status']);
        $task         = Tasks::find()->where(['id' => $id])->one();
        $task->status = (int)$status;
        $task->save();

        $user_id        = Yii::$app->user->id;
        $t              = time();
        $t              = date('Y-m-d', $t);
        $data           = new Notifications;
        $data->title    = "Задача выполнена";
        $data->datetime = $t;
        $data->user_id  = $user_id;
        $data->save();

        return true;
    }

    /**
     * @return string
     */
    public function actionAjaxGetOneDay()
    {
        $this->layout = false;
        $day   = htmlspecialchars($_GET['day']);
        $month = htmlspecialchars($_GET['month']);

        if (mb_strlen($month) == 1) {
            $month = '0' . $month;
        }
        if (mb_strlen($day) == 1) {
            $day = '0' . $day;
        }

        $tasks = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['month' => $month])
            ->andWhere(['day' => $day])
            //            ->orderBy([
            //                'datetime_end' => SORT_ASC,
            //                'time'         => SORT_ASC,
            //                'status'       => SORT_ASC,
            //            ])
            ->asArray()
            ->all();

        // var_dump($tasks);
        $html = '';
//        foreach ($tasks as $task) {
//            $time          = strtotime("{$task['day']}.{$task['month']}.{$task['year']}");
//            $date          = date('d.m.Y', $time);
//            $checked       = '';
//            $text_red      = '';
//            $alert         = '';
//            $task_complete = ' ';
//            $expired       = '';
//
//            $time          = strtotime("{$task['day']}.{$task['month']}.{$task['year']}");
//            $date          = date('d.m.Y', $time);
//            $checked       = '';
//            $text_red      = '';
//            $alert         = '';
//            $task_complete = ' ';
//            $expired       = '';
//            $html          .= '<div class="day-line">';
//            $html          .= '<div class="date">';
//            $html          .= date('d.m.Y', $task['datetime']);
//            $html          .= '</div>';
//
//            if (!$task['status']) {
//                $html .= "<div class='one-task'>";
//                $html .= "<input type='checkbox' class='task-checkbox' data-id='{$task['id']}'>";
//            } else {
//                $html .= "<div class='one-task task-complete'>";
//                $html .= "<input type='checkbox' class='task-checkbox' checked='checked' data-id='{$task['id']}'>";
//            }
//
//            $html .= "<div class='task-content edit-task' data-id='{$task['id']}'>";
//            $html .= "<b> {$task['title']}</b><br>";
//            $html .= nl2br($task['description']);
//            $html .= "</div>";
//            $html .= "</div>";
//
//            $html .= "</div>";
//        }

        $task_by_days = [];

        foreach ($tasks as $data) {
            $task_by_days[$data['datetime_end']] = $data;
        }

        $html .= "<div class='row' style='margin-left: 15px; margin-bottom: 30px'>";
        $html .= "<div class='col-md-5'><b>Наименование</b></div>";
        $html .= "<div class='col-md-1'>Время</div>";
        $html .= "<div class='col-md-2'>Дело</div>";
        $html .= "<div class='col-md-2'>Ответственный</div>";
        $html .= "<div class='col-md-2'>Постановщик</div>";
        $html .= "</div>";

        foreach ($task_by_days as $day => $task) {
            $html .= $this->render('_dayLine', [
                'day' => $day,
            ]);
        }

        return $html;
    }

    public function actionAjaxGetSevenDay()
    {
        $day   = htmlspecialchars($_GET['day']);
        $month = htmlspecialchars($_GET['month']);
        $year  = htmlspecialchars($_GET['year']);

        $start = mktime(0, 0, 0, $month, $day, $year);
        $end   = $start + 604800;

        $end   = date('Y-m-d', $end);
        $start = date('Y-m-d', $start);
        // 
        // 
        // $tasks = Tasks::find()
        //     ->innerJoin('clients', 'tasks.client_id = clients.id')
        //     ->where(['user_id' => Yii::$app->user->id])
        //     ->andWhere(['between', 'datetime_end', $start, $end])
        //     ->asArray()
        //     ->all();

        $tasks = Tasks::find()
            ->select([
                'tasks.*',
                'clients.first_name',
                'clients.family',
            ])
            ->innerJoin('clients', 'tasks.client_id = clients.id')
            ->where(['tasks.creator_id' => Yii::$app->user->id])
            ->andWhere([
                'between',
                'datetime_end',
                $start,
                $end,
            ])
            ->orderBy([
                'datetime_end' => SORT_ASC,
                'time'         => SORT_ASC,
            ])
            ->all();

        $html     = '';
        $last_day = $day;
        foreach ($tasks as $task) {
            $time          = strtotime("{$task['day']}.{$task['month']}.{$task['year']}");
            $date          = date('d.m.Y', $time);
            $checked       = '';
            $text_red      = '';
            $alert         = '';
            $task_complete = ' ';
            $expired       = '';

            if (!(int)$task['status']) {
                $text_red = 'text-danger';
                $alert    = 'alert alert-secondary';
                $expired  = 'Просрочена с ';
            }
            if ((int)$task['status']) {
                $task_complete = ' task-complete ';
                $checked       = 'checked';
                $expired       = '';
            }
            if (!(int)$task['status'] && $time > time()) {
                $checked  = '';
                $text_red = '';
                $alert    = 'alert alert-primary';
                $expired  = '';
            }

            if (!(int)$task['status'] && $time < time()) {
                $text_red = 'text-danger';
                $alert    = 'alert alert-secondary';
                $expired  = 'Просрочена с ';
                $checked  = '';
            }

            if ($last_day != $task['day']) {
                setlocale(LC_TIME, 'ru_RU.utf8');
                $date           = strtotime(date('d-m-Y', $time)); // Преобразование строки в timestamp
                $formatted_date = strftime('%e %B %Y', $date);     // Форматирование даты

                $html     .= "<p class='text-center h4 my-5'>Задачи на " . $formatted_date . "</p>";
                $last_day = $task['day'];
            }

            $worker = User::find()->where(['id' => $task['creator_id']])->asArray()->one();
            $mentor = User::find()->where(['id' => $task['user_id']])->asArray()->one();

            $time = explode(":", $task['time']);
            $html .= '<div class="card my-3 one-task  ' . $task_complete . ' " data-main-' . $task['id'] . '>
                           <div class="card-header ' . $alert . '">
                           ' . $expired . $date . '
                           <span type="button" class="p-2 action_icons btn_delete float-right"  onclick="deleteTask(' .
                $task['id'] . ')">✖</span>
                            </div>
                            
                            <div class="card-body row   ' . $task_complete . ' ' . $text_red . '">
                            <input type="checkbox" ' . $checked . '  class="task-checkbox col-1" data-id=' .
                $task['id'] . '>
                            <div class="blockquote mb-0 col-5 " >
                            
                            <p class="h4" contenteditable="true" oninput="changeTask(' . $task['id'] .
                ')" data-title-' . $task['id'] . '>' . $task['title'] . ' </p>
                            <p class="h6" contenteditable="true" oninput="changeTask(' . $task['id'] .
                ')" data-description-' . $task['id'] . ' >' . $task['description'] . '</p>    
                             <a href="/index.php?r=clients&client_id=' . $task['client_id'] . '">&#128279;</a>
                            </div>
                            <div class="blockquote mb-0 col-2 text-center" >
                            <input type="time" value="' . $time[0] . ':' . $time[1] . '"  data-time-' . $task['id'] .
                ' class="w-75" onchange="changeTask(' . $task['id'] . ')"/>

                            </div>
                            <div class="blockquote mb-0 col-2 text-center" >
                            ' . $worker['username'] . '
                            ' . $worker['second_name'] . '
                              </div>
                              <div class="blockquote mb-0 col-2 text-center" >
                              ' . $mentor['username'] . '
                              ' . $mentor['second_name'] . '
                              </div>
                            <div class="blockquote mb-0 col-1" hidden>
                            <span type="button" class="p-2 action_icons"  onclick="changeTask(' . $task['id'] . ')" >✎</span>
                            <span type="button" class="p-2 action_icons btn_delete"  onclick="deleteTask(' .
                $task['id'] . ')">✖</span>
                            </div>
                            </div>
                    </div>';
        }

        return $html;
    }

    public function actionAjaxGetCalendar()
    {
        $html = "<div id='calendar' class='calendar'>
        <div class='calendar-title'>
          <div class='calendar-title-text'></div>
          <div class='calendar-button-group'>
            <button id='prevMonth'>&lt;</button>
            <button id='today'>Today</button>
            <button id='nextMonth'>&gt;</button>
          </div>
        </div>
        <div class='calendar-day-name'></div>
        <div class='calendar-dates'></div>
      </div>
     ";

        return $html;
    }

    public function actionAjaxDeleteTask()
    {
        //  index.php?r=calendar/ajax-delete-task&id=36/
        $task_id = htmlspecialchars($_GET['id']);
        $task    = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['id' => $task_id])->one()->delete();

        //    уведомление создаем
        $user_id        = Yii::$app->user->id;
        $t              = time();
        $t              = date('Y-m-d', $t);
        $data           = new Notifications;
        $data->title    = "Задача удалена";
        $data->datetime = $t;
        $data->user_id  = $user_id;
        $data->save();

        return $task;
    }

    public function actionAjaxChangeTask()
    {
        $task_id = htmlspecialchars($_GET['id']);
        // $day   = htmlspecialchars($_GET['day']);
        // $month = htmlspecialchars($_GET['month']);
        // $year = htmlspecialchars($_GET['year']);
        $title       = htmlspecialchars($_GET['tasktitle']);
        $description = htmlspecialchars($_GET['taskdescription']);
        $time        = htmlspecialchars($_GET['time']);

        // $task = Tasks::findOne($task_id)->one();

        $task = Tasks::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['id' => $task_id])->one();

        // $task->day = $day;
        // $task->month = $month;
        // $task->year = $year;
        $task->title       = $title;
        $task->description = $description;
        $task->time        = $time;

        return $task->save();
    }

    public function actionRow()
    {
        // $tasks = Tasks::find()
        // ->select(['tasks.*', 'clients.first_name', 'clients.family'])
        // ->innerJoin('clients', 'tasks.client_id = clients.id')
        // ->where(['user_id' => Yii::$app->user->id])
        // ->all();
        $tasks = Tasks::find()
            ->select([
                'tasks.*',
                'clients.first_name',
                'clients.family',
            ])
            ->innerJoin('clients', 'tasks.client_id = clients.id')
            ->where(['tasks.user_id' => Yii::$app->user->id])
            ->all();
        // ->all();
        echo '<pre>';
        foreach ($tasks as $key => $row) {
            var_dump($row['title']);
        }
        echo '</pre>';
    }
}
