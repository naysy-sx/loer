<?php

namespace app\controllers;

use Codeception\Module\Yii2;
use Yii;
use app\models\db\ClientDocuments;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientDocumentController implements the CRUD actions for ClientDocuments model.
 */
class DocumentsController extends Controller
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
     * Отключение CSRF проверки
     *
     * @param \yii\base\Action $action
     *
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Lists all ClientDocuments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ClientDocuments::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ClientDocuments model.
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
    
    public function actionCheck()
    {
        echo 'dfgd';
    }

    public function actionCreate()
    {
        try {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
            // Получение и валидация обязательных полей
            $creator_id = (int)Yii::$app->request->post('creator_id');
            $title = Yii::$app->request->post('title', 'Новый документ');
            $createDate = date('Y-m-d H:i:s');
    
            if ($creator_id <= 0) {
                return [
                    'success' => false,
                    'message' => 'Неверный ID создателя',
                    'errors' => ['creator_id' => 'Должно быть положительным числом']
                ];
            }
    
            // Получение остальных данных
            $type = Yii::$app->request->post('type');
            $pravo = Yii::$app->request->post('pravo');
            $content = Yii::$app->request->post('content');
            $folder_id = Yii::$app->request->post('folder_id');
    
            // Создание и заполнение модели
            $model = new ClientDocuments(); 
            $model->creator_id = $creator_id;
            $model->create_date = $createDate;
            $model->title = $title;
            $model->type = $type;
            $model->pravo = $pravo;
            $model->content = $content;
            $model->folder_id = $folder_id !== null ? (int)$folder_id : 0;
            $model->publish_status = 1;
    
            // Сохранение модели
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => 'Документ успешно сохранен',
                    'document_id' => $model->id
                ];
            } else {
                Yii::error('Ошибка сохранения документа: ' . json_encode($model->getErrors()));
                return [
                    'success' => false,
                    'message' => 'Не удалось сохранить документ',
                    'errors' => $model->getErrors()
                ];
            }
        } catch (\Exception $e) {
            Yii::error('Исключение при создании документа: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Произошла ошибка при создании документа',
                'error' => YII_DEBUG ? $e->getMessage() : null
            ];
        }
    }

    public function actionSave($id)
    {
/* Этот пример разобрать
        if ($model->load(Yii::$app->request->post())) {
            $model->money = 'something';
            $model->username = 'something';
            $model->save();
        }
*/
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;   
    
        // Получаем данные из запроса
        $userID = Yii::$app->request->get('userID');
        $title = Yii::$app->request->get('title');
        $type = Yii::$app->request->get('type');
        $pravo = Yii::$app->request->get('pravo');
        $folderID = Yii::$app->request->get('folderID');
        $content = Yii::$app->request->get('content');
    
        // Находим документ по ID
        $model = ClientDocuments::findOne($id);
    
        if ($model === null) {
            echo 'Документ не найден';
            return [
                'success' => false,
                'message' => 'Документ не найден'
            ];
        }
    
        // Обновляем данные документа
        $model->creator_id = $userID;
        $model->title = $title;
        $model->type = $type;
        $model->pravo = $pravo;
        $model->folder_id = $folderID;
        $model->content = $content;
    
        if ($model->save()) {
            return [
                'success' => true,
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Не удалось сохранить документ',
                'errors' => $model->getErrors()
            ];
        }
    }

    /**
     * Deletes an existing ClientDocuments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $documentID = Yii::$app->request->get('documentID');
        $newTitle = Yii::$app->request->get('newTitle');
        $userId = Yii::$app->request->get('user_id'); // Предполагается, что user_id передается в запросе
        $model = ClientDocuments::findOne($documentID);

        if ($model && $model->creator_id == $userId) {
            $model->title = $newTitle;
    
            if ($model->save()) {
                $model->title = $newTitle;
                $documents = ClientDocuments::find()->where([
                    'creator_id' => $userId,
                    'publish_status' => 1
                    ])->all();
                    $renamedDocumentListHtml = '';
        
                function generateDocumentItemHtml($document) {
                    return sprintf(
                    '<li class="document-list-item">
                        <span>
                            <b>🖿</b>
                            <a href="" class="document" data-id="%d">%s</a>
                        </span>
                        <div>
                            <a href="#" class="rename" data-id="%d" data-type="document">переименовать</a>
                            <a href="#" class="delete" data-id="%d" data-type="document">удалить</a>
                        </div>
                    </li>
                    ',
                        $document->id,
                        $document->title,
                        $document->id,
                        $document->id
                    );
                }
                
                foreach ($documents as $document) {
                    $renamedDocumentListHtml .= generateDocumentItemHtml($document);
                }
                
                return [
                    'success' => true,
                    'renamedDocumentListHtml' => $renamedDocumentListHtml
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

    public function actionRemove()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $documentID = Yii::$app->request->get('documentID');
        $userID = Yii::$app->request->get('userID'); 
        $model = ClientDocuments::findOne($documentID);
    
        if ($model === null) {
            return [
                'success' => false,
                'message' => 'Папка не найдена',
                'errors' => [],
            ];
        }
    
        if ($model->creator_id == $userID) {
            $model->publish_status = 0;
    
            if ($model->save()) {
                $documents = ClientDocuments::find()->where([
                    'creator_id' => $userID,
                    'publish_status' => 1
                ])->all();

                echo $documents;
    
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
    
                foreach ($documents as $document) {
                    $updatedDocumentsListHtml .= generateDocumentItemHtml($document);
                }
    
                return [
                    'success' => true,
                    'updatedDocumentListHtml' => $updatedDocumentsListHtml,
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
     * Finds the ClientDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ClientDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ClientDocuments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
