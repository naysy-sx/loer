<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Class HelpController
 * @package app\controllers
 */
class HelpController extends Controller
{
    public $layout = 'help';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}