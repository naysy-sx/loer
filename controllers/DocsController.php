<?php

namespace app\controllers;

use Yii;
use app\models\db\Docs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

class DocsController extends Controller
{
  public function actionIndex()
  {
    $folders = Docs::find()->where(['is_folder' => 1])->all();
    $docs = Docs::find()->where(['is_folder' => 0])->all();

    return $this->render('index', [
      'folders' => $folders,
      'docs' => $docs,
    ]);
  }
  /*
    public function actionCreateFolder()
    {
        $model = new Docs();
        $model->is_folder = 1;
        $model->title = Yii::$app->request->post('title');
        if ($model->save()) {
            return $this->asJson(['success' => true, 'id' => $model->id, 'title' => $model->title]);
        } else {
            return $this->asJson(['success' => false]);
        }
    }

	public function actionSaveModalForm()
	{
		$id        = htmlspecialchars($_GET['id']);
		$cr_client = Clients::find()->where(['id' => $id])->one();

		foreach ($_GET as $key => $value) {
			if ($key !== 'id' && $key !== 'r' && !empty($value)) {
				$cr_client->$key = htmlspecialchars($value);
			}
		}

		$cr_client->save();

		return true;
	}

*/
  public function actionCreateFolder()
  {
    // Получаем данные из запроса
    $title = Yii::$app->request->get('title');
    $user_id = Yii::$app->request->get('user_id');

    // Проверяем, передано ли название папки
    if (empty($title)) {
      return $this->asJson([
        'success' => false,
        'error' => 'Название папки не может быть пустым.'
      ]);
    }

    // Создаем новую запись в модели Docs
    $docs = new Docs();
    $docs->title = $title;
    $docs->is_folder = 1;
    $docs->user_id = $user_id;
    $docs->create_date = date('Y-m-d H:i:s');
    $docs->last_modified_date = date('Y-m-d H:i:s');
    $docs->version = 1;


    if ($docs->save()) {
      return $this->asJson([
        'success' => true,
        'id' => $docs->id,
        'title' => $docs->title,
        'user_id' => $docs->user_id
      ]);
    } else {
      return $this->asJson([
        'success' => false,
        'error' => 'Не удалось создать папку. Попробуйте еще раз.',
        'validationErrors' => $docs->getErrors()
      ]);
    }
  }

  public function actionListFolders()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;

    $userId = Yii::$app->request->get('user_id');

    if ($userId) {
      $folders = Docs::find()
        ->where([
          'is_folder' => 1,
          'user_id' => $userId
        ])
        ->asArray()
        ->all();

      return [
        'success' => true,
        'folders' => $folders,
      ];
    } else {
      return [
        'success' => false,
        'error' => 'User ID is missing.',
      ];
    }
  }

  public function actionListDocs()
  {
    Yii::$app->response->format = Response::FORMAT_JSON;

    $userId = Yii::$app->request->get('user_id');

    if ($userId) {
      $docs = Docs::find()
        ->where([
          'is_folder' => 0,
          'user_id' => $userId
        ])
        ->asArray()
        ->all();

      return [
        'success' => true,
        'docs' => $docs,
      ];
    } else {
      return [
        'success' => false,
        'error' => 'User ID is missing.',
      ];
    }
  }


  public function actionCreateDocument()
  {

    $title = Yii::$app->request->get('title');
    $type = Yii::$app->request->get('type');
    $pravo = Yii::$app->request->get('pravo');
    $category = Yii::$app->request->get('pravo');
    $content = Yii::$app->request->get('content');
    $folderTitle = Yii::$app->request->get('folder');
    $userId = Yii::$app->request->get('user_id');

    $folderExisting = Docs::find()
      ->where([
        'is_folder' => 1,
        'title' => $folderTitle,
        'user_id' => $userId
      ])
      ->one();

    echo 'EXISTING' . '<br>';

    echo "<pre>";
    print_r($folderExisting);
    echo "</pre>";

    // если папки не было создаём новую папку в таблице

    if (!$folderExisting) {
      $folder = new Docs();
      $folder->is_folder = 1;
      $folder->title = $folderTitle;
      $folder->user_id = $userId;
      $folder->create_date = date('Y-m-d H:i:s');
      $folder->save();
    }

    // Далее создаём документ
    $doc = new Docs();

    $doc->title = $title;
    $doc->content = $content;
    $doc->category = $type;
    $doc->pravo = $pravo;
    $doc->user_id = $userId;
    $doc->create_date = date('Y-m-d H:i:s');

    if (!$folderExisting) {
      $doc->folder = 'NO';
    }else{
      $doc->folder = 'ROOT';
    }


    echo "<pre>";
    print_r('ПОЛЯ ЗАПОЛНЕНЫ');
    echo "</pre>";


    if ($doc->save()) {
      echo "<pre>";
      print_r('УСПЕШНО');
      echo "</pre>";
  
      return [
          'success' => true,
          'id' => $doc->id,
          'category' => $doc->category,
          'pravo' => $doc->pravo,
          'user_id' => $doc->user_id,
          'title' => $doc->title
      ];
  } else {
      echo "<pre>";
      print_r('ОШИБКА');
      echo "</pre>";
  
      // Получение ошибок валидации
      $errors = $doc->getErrors();
  
      echo "<pre>";
      print_r($errors);
      echo "</pre>";
  
      return [
          'success' => false,
          'error' => 'Failed to create document',
          'errors' => $errors
      ];
  }




/*

    $folderID = Docs::find()
      ->where([
        'is_folder' => 1,
        'title' => $folderTitle,
        'user_id' => $userId
      ])
      ->one();

    if (!$folderID && $folderTitle) {

      $folder = new Docs();
      $folder->is_folder = 1;
      $folder->title = $folderTitle;
      $folder->user_id = $userId;
      $folder->create_date = date('Y-m-d H:i:s');
      $folder->save();
    }

    $folderId = $folder ? $folder->id : null;

    $doc = new Docs();
    $doc->is_folder = 0;
    $doc->title = $title;
    $doc->category = $category;
    $doc->pravo = $type;
    $doc->folder = $folderId;
    $doc->user_id = $userId;
    $doc->create_date = date('Y-m-d H:i:s');

    if ($doc->save()) {
      return [
        'success' => true,
        'id' => $doc->id,
        'title' => $doc->title
      ];
    } else {
      return [
        'success' => false,
        'error' => 'Failed to create document'
      ];
    }
*/

    /*
        $model = new Docs();
        $model->title = Yii::$app->request->post('title');
        $model->folder = Yii::$app->request->post('folder');
        if ($model->save()) {
            return $this->asJson(['success' => true, 'id' => $model->id, 'title' => $model->title]);
        } else {
            return $this->asJson(['success' => false]);
        }

        */
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $model->title = Yii::$app->request->post('title');
    if ($model->save()) {
      return $this->asJson(['success' => true, 'id' => $model->id, 'title' => $model->title]);
    } else {
      return $this->asJson(['success' => false]);
    }
  }

  public function actionDelete($id)
  {
    $this->findModel($id)->delete();
    return $this->asJson(['success' => true]);
  }

  protected function findModel($id)
  {
    if (($model = Docs::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
