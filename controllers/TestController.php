<?php

namespace app\controllers;

use app\models\db\Clients;
use app\models\db\PdfTemplates;
use Yii;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionIndex()
    {
        $clients = Clients::find()
            ->where(['user_id' => \Yii::$app->user->id])
            ->asArray()
            ->all();

        $model = new Clients;

        return $this->render('index', [
            'clients' => $clients,
            'model'   => $model,
        ]);
    }

    public function actionDocName()
    {
        // чистим таблицу
        Yii::$app->db->createCommand()->truncateTable('pdf_templates')->execute();

        $dir   = './../views/pdf-creator';
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && $file != '.DS_Store' && $file != 'fonts' && $file != 'editor.php' &&
                $file != 'clear.php') {
                $new_template                = new PdfTemplates;
                $new_template->doc_title     = $file;
                $new_template->cyrilic_title = $file;
                $new_template->path          = "views/pdf-creator/{$file}";
                $new_template->save();

                echo 'ага';
            }
        }
    }
}