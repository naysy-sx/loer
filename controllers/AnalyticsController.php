<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Class AnalyticsController
 * @package app\controllers
 */
class AnalyticsController extends Controller
{
    public $layout = 'analytics';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}