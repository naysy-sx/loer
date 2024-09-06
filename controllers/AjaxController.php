<?php
namespace app\controllers;

use app\models\db\Companys;
use app\models\db\Tasks;
use app\models\Encryption;
use app\models\LoginForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        exit;
    }

    /**
     * Обработчик регистрации
     *
     * @return bool|string
     */
    public function actionRegister()
    {
        // ловим ошибки
        if ($_GET['name']) {
            $name = htmlspecialchars($_GET['name']);
        } else {
            return 'err_name';
        }
        if ($_GET['login']) {
            $login = htmlspecialchars($_GET['login']);
        } else {
            return 'err_login';
        }
        if ($_GET['password']) {
            $pass = htmlspecialchars($_GET['password']);
        } else {
            return 'err_pass';
        }

        if ($_GET['role']) {
            $role = htmlspecialchars($_GET['role']);
        } else {
            return 'role_error';
        }

        if (!self::userNameIsMail($login)) {
            return 'login_no_email';
            exit;
        }
        if (self::checkUserName($login)) {
            return 'user_already_exists';
            exit;
        }

        // если ошибок нет - регистрируем

        // автосоздание компании
        $company_rand = rand(1100, 9999);

        $new_company          = new Companys;
        $new_company->user_id = 0;
        $new_company->name    = "Новая компания №{$company_rand}";
        $new_company->save();

        // создание юзера
        $new_user                     = new User;
        $new_user->email              = $login;
        $new_user->company_name       = (string)$new_company->id;
        $new_user->username           = $name;
        $new_user->password_hash      = Encryption::encWOK($pass);
        $rand_auth_key                = md5(rand(100, 99999));
        $new_user->auth_key           = $rand_auth_key;
        $new_user->status             = '10';  // 5 - зарегистрирован, но не подтвержден. 10 - подтвержден, активен
        $new_user->type_user          = $role; // Тип  пользователя  1 - пользователь / 2- компания
        $new_user->city               = '2';
        $new_user->created_at         = '1';
        $new_user->updated_at         = '1';
        $new_user->show_arrival_price = 1;
        $new_user->acc_level          = 1;
        $new_user->type               = '1';

        if ($new_user->save()) {
            // Отправить письмо приветственное
            $res = Yii::$app->mailer->compose()
                ->setFrom('admin@lawico.ru')
                ->setTo($login)
                ->setSubject('Приветствие!')
                ->setTextBody('Вы стали новым пользователем сервиса lawico')
                ->setHtmlBody('Ознакомьтесь с нашей инструкцией, для быстрого погружения в наш сервис')
                ->send();

            // Обновить созданную компанию (добавить user_id)
            /** @var Companys $cr_company */
            $cr_company          = Companys::find()->where(['id' => $new_company->id])->one();
            $cr_company->user_id = $new_user->id;
            $cr_company->save();

            return true;
        }

        echo '<pre>';
        var_dump($new_user);

        return 'error';
    }

    /**
     * Обработчик авторизации
     *
     * @return bool|string
     */
    public function actionLogin()
    {
        if ($_GET['login']) {
            $login = htmlspecialchars($_GET['login']);
        } else {
            return 'err_login';
        }
        if ($_GET['pass']) {
            $pass = htmlspecialchars($_GET['pass']);
        } else {
            return 'err_pass';
        }
        // получаем логин и пароль, проверяем, авторизируем, если все ок
        $login_form = new LoginForm;
        $login_form->load(Yii::$app->request->get());
        $login_form->username = $login;
        $login_form->password = $pass;
        if ($login_form->login()) {
            return true;
        }

        return 'wrong_pass';
    }

    /**
     * Проверка, зарегистрирован ли уже такой аккаунт
     *
     * @param $u_name
     *
     * @return bool
     */
    private static function checkUserName($u_name): bool
    {
        $user = User::find()
            ->where(['email' => $u_name])
            ->one();
        if ($user) {
            return true;
        }

        return false;
    }

    /**
     * Проверка, является ли введенный логин почтой
     *
     * @param $u_name
     *
     * @return bool
     */
    private static function userNameIsMail($u_name): bool
    {
        if (preg_match("/[0-9a-z]+@[a-z]/", $u_name)) {
            return true;
        }

        return false;
    }

    /**
     * Получение данных для модалки редактирования задачи
     *
     * @return false|string
     */
    public function actionGetDataByTaskModal()
    {
        $task_id = htmlspecialchars($_GET['id']);
        $cr_task = Tasks::find()
            ->where(['id' => $task_id])
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->asArray()
            ->one();

        $cr_task['datetime'] = date('Y-m-d', $cr_task['datetime']);

        return json_encode($cr_task);
    }

    /**
     * Сохранение данных из модалки редактирования задачи
     *
     * @return false|string
     */
    public function actionSaveDataByTaskModal()
    {
        $task_id     = htmlspecialchars($_GET['id']);
        $title       = htmlspecialchars($_GET['title']);
        $description = htmlspecialchars($_GET['description']);
        $date        = htmlspecialchars($_GET['date']);
        $time        = htmlspecialchars($_GET['time']);

        $linuxtime = strtotime($date);
        $d         = date('d', $linuxtime);
        $m         = date('m', $linuxtime);
        $y         = date('Y', $linuxtime);

        if (isset($_GET['client_id']) && mb_strlen($_GET['client_id']) > 0 && $_GET['client_id'] != 0) {
            $client_id = $_GET['client_id'];
        } else {
            $client_id = $_GET['lead_id'];
        }

        /** @var Tasks $cr_task */
        $cr_task = Tasks::find()
            ->where(['id' => $task_id])
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->one();

        $cr_task->title        = $title;
        $cr_task->client_id    = $client_id;
        $cr_task->description  = $description;
        $cr_task->datetime     = strtotime($date);
        $cr_task->datetime_end = date('Y-m-d', strtotime($date));
        $cr_task->time         = $time;
        $cr_task->day          = $d;
        $cr_task->month        = $m;
        $cr_task->year         = $y;
        var_dump($cr_task->save());

        var_dump($cr_task);

        return true;
    }
}