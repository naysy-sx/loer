<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**
 * Основной контроллер (базовые действия)
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest){
            return $this->redirect(['site/login']);
        }

        return $this->redirect(['user/index']);
    }

    /**
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = 'login';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('login');
    }

    /**
     * @return string|Response
     */
    public function actionReg()
    {
        $this->layout = 'reg';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('reg');
    }

    /**
     * @return string|Response
     */
    public function actionRecovery()
    {
        $this->layout = 'recovery';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        return $this->render('recovery');
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
