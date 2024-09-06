<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\db\Companys;
use app\models\User;
use Yii;
use yii\web\Controller;

/**
 * Class MyCompanyController
 * @package app\controllers
 */
class MyCompanyController extends Controller
{
    public $layout = 'my-company-all';

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
     * @return bool
     */
    public function actionAjaxSaveData()
    {
        if ($_GET['company_name']) {
            $name = htmlspecialchars($_GET['company_name']);
        } else {
            $name = 'Название компании';
        }

        if ($_GET['company_description']) {
            $company_description = htmlspecialchars($_GET['company_description']);
        } else {
            $company_description = 'Описание компании';
        }

        if ($_GET['inn']) {
            $inn = htmlspecialchars($_GET['inn']);
        } else {
            $inn = '';
        }

        if ($_GET['kpp']) {
            $kpp = htmlspecialchars($_GET['kpp']);
        } else {
            $kpp = '';
        }

        if ($_GET['bank']) {
            $bank = htmlspecialchars($_GET['bank']);
        } else {
            $bank = '';
        }

        if ($_GET['ks']) {
            $ks = htmlspecialchars($_GET['ks']);
        } else {
            $ks = '';
        }

        /** @var Companys $current_company */
        $current_company              =
            Companys::find()->where(['user_id' => Yii::$app->user->id])->one();

        if (!$current_company){
            $current_company = new Companys;
            $current_company->user_id = Yii::$app->user->id;
        }

        $current_company->name        = $name;
        $current_company->description = $company_description;
        $current_company->inn         = $inn;
        $current_company->kpp         = $kpp;
        $current_company->bank        = $bank;
        $current_company->ks          = $ks;
        $current_company->save();


        return true;
    }
}