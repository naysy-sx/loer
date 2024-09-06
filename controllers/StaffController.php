<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\Encryption;
use app\models\User;
use Yii;
use yii\base\BaseObject;
use yii\web\Controller;

/**
 * Сотрудники
 * @package app\controllers
 */
class StaffController extends Controller
{
    public $layout = 'my-company-all';

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

    /**
     * Отображение всех сотрудников
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Добавление сотрудника
     *
     * @return string|\yii\web\Response
     */
    public function actionAdd()
    {
        $model = new User;

        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Encryption::enc($model->password_hash);
            $model->auth_key = Encryption::enc($model->password_hash);
            $model->created_at = time();
            $model->updated_at = time();
            $model->company_name = Yii::$app->user->identity->company_name;
            $model->acc_level = 1;
            $model->save();

            return $this->redirect(['staff/index']);
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    /**
     * Редактирование сотрудника
     *
     * @return string|\yii\web\Response
     */
    public function actionEdit()
    {
        $id = htmlspecialchars($_GET['id']);
        $model = User::find()->where(['id' => $id])->one();
        $model->password_hash = Encryption::deenc($model->password_hash);

        // заглушка от редактирования чужых сотрудников todo: временная, переделать
        if ($model->company_name != Yii::$app->user->identity->company_name){
            exit;
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->password_hash = Encryption::enc($model->password_hash);
            $model->auth_key = Encryption::enc($model->password_hash);
            $model->created_at = time();
            $model->updated_at = time();
            $model->company_name = Yii::$app->user->identity->company_name;
            $model->acc_level = 1;
            $model->save();

            return $this->redirect(['staff/index']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }


    /**
     * Аналитика работы сотрудника
     *
     * @return string
     */
    public function actionStats()
    {
        return $this->render('stats');
    }
}