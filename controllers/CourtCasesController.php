<?php

namespace app\controllers;

use app\models\db\CourtCases;
use Yii;
use yii\web\Controller;

/**
 * Судебные дела
 * @package app\controllers
 */
class CourtCasesController extends Controller
{
    public $layout = 'court-cases';

    /**
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
        $this->layout = false;

        $model              = new CourtCases;
        $model->company_id  = 1;
        $model->user_id     = Yii::$app->user->id;
        $model->client_id   = htmlspecialchars($_GET['client']);
        $model->court_id    = htmlspecialchars($_GET['court']);
        $model->case_number = htmlspecialchars($_GET['ordernumber']);
        $model->save();

        return true;
    }
}