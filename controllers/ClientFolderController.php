<?php

namespace app\controllers;

use Yii;
use app\models\db\ClientFolders;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientFolderController implements the CRUD actions for ClientFolders model.
 */
class ClientFolderController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ClientFolders models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClientFolders::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientFolders model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ClientFolders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        echo "YA!!!";
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        $folderName = \Yii::$app->request->get('folder_name');
        $userId = \Yii::$app->request->get('user_id');

        var_dump($folderName);
        var_dump($userId);

    
        $model = new ClientFolders();
        $model->title = $folderName;
        $model->user_id = $userId;
    
        if ($model->save()) {
            // Получаем обновленный список папок
            $folders = ClientFolders::find()->where(['user_id' => $userId])->all();
    
            // Рендерим частичное представление со списком папок
            $folderListHtml = $this->renderPartial('_folder_list', ['folders' => $folders]);
    
            return [
                'success' => true,
                'folderListHtml' => $folderListHtml
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Не удалось создать папку'
            ];
        }
    }

    /**
     * Updates an existing ClientFolders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ClientFolders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ClientFolders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientFolders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientFolders::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
