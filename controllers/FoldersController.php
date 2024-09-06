<?php

namespace app\controllers;

use Yii;
use app\models\db\ClientFolders;
use app\models\db\ClientDocuments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientFolderController implements the CRUD actions for ClientFolders model.
 */
class FoldersController extends Controller
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
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;    
        $folderName = Yii::$app->request->get('folder_name');
        $userId = Yii::$app->request->get('user_id');    
        $createDate = date('Y-m-d H:i:s');
        $model = new ClientFolders();
    
        $model->title = $folderName;
        $model->creator_id = $userId;    
        $model->create_date = $createDate;
        $model->publish_status = 1;
    
        if ($model->save()) {
            $folders = ClientFolders::find()->where([
                'creator_id' => $userId,
                'publish_status' => 1
                ])->all();
        
            $folderListHtml = '';
        
            function generateFolderItemHtml($folder) {
                return sprintf(
                '<li class="folder-list-item">
                    <span>
                        <b>🖿</b>
                        <a href="" class="folder" data-id="%d">%s</a>
                    </span>
                    <div>
                        <a href="#" class="rename-folder" data-id="%d" data-type="folder">переименовать</a>
                        <a href="#" class="delete-folder" data-id="%d" data-type="folder">удалить</a>
                    </div>
                </li>
                ',
                    $folder->id,
                    $folder->title,
                    $folder->id,
                    $folder->id
                );
            }
            
            foreach ($folders as $folder) {
                $folderListHtml .= generateFolderItemHtml($folder);
            }
            
            return [
                'success' => true,
                'folderListHtml' => $folderListHtml
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Не удалось создать папку',
                'errors' => $model->getErrors()
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
    public function actionUpdate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $folderID = Yii::$app->request->get('folderID');
        $newTitle = Yii::$app->request->get('newTitle');
        $userId = Yii::$app->request->get('user_id'); // Предполагается, что user_id передается в запросе
        $model = ClientFolders::findOne($folderID);

        if ($model && $model->creator_id == $userId) {
            $model->title = $newTitle;
    
            if ($model->save()) {
                $model->title = $newTitle;
                $folders = ClientFolders::find()->where([
                    'creator_id' => $userId,
                    'publish_status' => 1
                    ])->all();
                    $renamedFolderListHtml = '';
        
                function generateFolderItemHtml($folder) {
                    return sprintf(
                    '<li class="folder-list-item">
                        <span>
                            <b>🖿</b>
                            <a href="" class="folder" data-id="%d">%s</a>
                        </span>
                        <div>
                            <a href="#" class="rename-folder" data-id="%d" data-type="folder">переименовать</a>
                            <a href="#" class="delete-folder" data-id="%d" data-type="folder">удалить</a>
                        </div>
                    </li>
                    ',
                        $folder->id,
                        $folder->title,
                        $folder->id,
                        $folder->id
                    );
                }
                
                foreach ($folders as $folder) {
                    $renamedFolderListHtml .= generateFolderItemHtml($folder);
                }
                
                return [
                    'success' => true,
                    'renamedFolderListHtml' => $renamedFolderListHtml
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Не удалось обновить папку',
                    'errors' => $model->getErrors()
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Папка не найдена или у вас нет прав на её обновление'
            ];
        }
    }

    /**
     * Deletes an existing ClientFolders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRemove()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $folderID = Yii::$app->request->get('folderID');
        $userID = Yii::$app->request->get('userID'); 
        $model = ClientFolders::findOne($folderID);
    
        if ($model === null) {
            return [
                'success' => false,
                'message' => 'Папка не найдена',
                'errors' => [],
            ];
        }
    
        if ($model->creator_id == $userID) {
            $model->publish_status = 0;



            $documents = ClientDocuments::findAll(['folder_id' => $folderID]);
            foreach ($documents as $document) {
                    $document->publish_status = 0;
                    $document->save();
            }
   
            if ($model->save()) {
                $folders = ClientFolders::find()->where([
                    'creator_id' => $userID,
                    'publish_status' => 1
                ])->all();
    
                $updatedFolderListHtml = '';
    
                function generateFolderItemHtml($folder) {
                    return sprintf(
                        '<li class="folder-list-item">
                            <span>
                                <b>🖿</b>
                                <a href="" class="folder" data-id="%d">%s</a>
                            </span>
                            <div>
                                <a href="#" class="rename-folder" data-id="%d" data-type="folder">переименовать</a>
                                <a href="#" class="delete-folder" data-id="%d" data-type="folder">удалить</a>
                            </div>
                        </li>',
                        $folder->id,
                        $folder->title,
                        $folder->id,
                        $folder->id
                    );
                }
    
                foreach ($folders as $folder) {
                    $updatedFolderListHtml .= generateFolderItemHtml($folder);
                }

    
                $updatedDocumentsListHtml = '';
    
                function generateDocumentItemHtml($document) {
                    return sprintf(
                        '<li class="docs-list-item">
                            <span>
                                <b>🖿</b>
                                <a href="" class="document" data-id="%d">%s</a>
                            </span>
                            <div>
                                <a href="#" class="delete-document" data-id="%d" data-type="document">удалить</a>
                            </div>
                        </li>',
                        $document->id,
                        $document->title,
                        $document->id,
                        $document->id
                    );
                }

                echo 'Обновление списка ';
    
                foreach ($documents as $document) {
                    $updatedDocumentsListHtml .= generateDocumentItemHtml($document);
                }

                echo 'Обновление списка ';

    
                return [
                    'success' => true,
                    'updatedFolderListHtml' => $updatedFolderListHtml,
                    'updatedDocsListHtml' => $updatedDocumentsListHtml,
                    'message' => 'Обновлено',
                    'errors' => [],
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Ошибка!',
                    'errors' => $model->getErrors(),
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Вы не авторизованы!',
                'errors' => [],
            ];
        }
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
