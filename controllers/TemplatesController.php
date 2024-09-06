<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\TemplatesDocs;

class TemplatesController extends Controller
{
    public $layout = false;

    public function actionIndex()
    {
        $models = TemplatesDocs::find()->asArray()->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }
}
