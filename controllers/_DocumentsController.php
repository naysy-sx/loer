<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Документы, доверенности, справки и тд
 * @package app\controllers
 */
class DocumentsController extends Controller
{
    public $layout = 'documents';

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Страница генератора документов
     *
     * @return string
     */
    public function actionGenerateDocument()
    {
        return $this->render('generate-document');
    }
}