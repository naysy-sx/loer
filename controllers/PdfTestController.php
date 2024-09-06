<?php
namespace app\controllers;

use app\models\db\Clients;
use app\models\db\TmpDoc;
use yii\web\Controller;

class PdfTestController extends Controller
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Сохранение дока
     *
     * @return bool
     */
    public function actionSave()
    {
        $this->layout = false;

        $doc = $_POST['doc'];

        $new_doc      = new TmpDoc;
        $new_doc->doc = $doc;
        $new_doc->save();

        echo '<pre>';
        var_dump($_GET);

        return true;
    }


    public function actionGenerate($id)
    {
        $client = [];

        if (!empty($_GET['client_id'])) {
            $client_id = htmlspecialchars($_GET['client_id']);
            $client    = Clients::find()->where(['id' => $client_id])->asArray()->one();
        }

        return $this->render('document', [
            'id'       => $id,
        ]);
    }
    public function actionCreate($id = null)
    {
        $client = [];
    
        if (!empty($_GET['client_id'])) {
            $client_id = htmlspecialchars($_GET['client_id']);
            $client    = Clients::find()->where(['id' => $client_id])->asArray()->one();
        }
    
        $isNewDocument = isset($_GET['new']) && $_GET['new'] == 1;
    
        return $this->render('create', [
            'id'            => $id,
            'isNewDocument' => $isNewDocument,
            'client'        => $client,
        ]);
    }


}