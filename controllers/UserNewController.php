<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\User;
use Throwable;
use Yii;
use yii\web\Controller;

/**
 * Class UserController
 * @package app\controllers
 */
class UserController extends Controller
{
    public $layout = 'user';

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
     * @return string
     */
    public function actionAccountSettings()
    {
        $model = User::find()->where(['id' => \Yii::$app->user->id])->one();

        return $this->render('account-settings', [
            'model' => $model,
        ]);
    }

    public function actionAjaxUserChange()
    {
        $username = htmlspecialchars($_GET['username']);
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $user->username = $username;
        try {

            return  $user->save();
        } catch (Throwable $e) {
            return  $e->getMessage();
        }
        // var_export($user->username);
        return 123;
    }
}
