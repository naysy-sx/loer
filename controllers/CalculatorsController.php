<?php

namespace app\controllers;

use yii\web\Controller;

class CalculatorsController extends Controller
{
    public $layout = 'calculators';

    public function actionDdy()
    {
        return $this->render('ddy');
    }

    public function action395()
    {
        return $this->render('395');
    }

    public function actionGosPOU(){
        return $this->render('gos-p-o-u');
    }

    public function actionGosPAS(){
        return $this->render('gos-p-a-s');
    }
}