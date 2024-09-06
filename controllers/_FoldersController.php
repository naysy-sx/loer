<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\db\Folders;
use app\models\db\UploadedFiles;
use Yii;
use yii\web\Controller;

/**
 * Файл-менеджер
 * @package app\controllers
 */
class FoldersController extends Controller
{
    public $layout = false;

    /**
     * Контроль доступа
     *
     * @param \yii\base\Action $action
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        MainAccess::ifGuestGoHome();

        return parent::beforeAction($action);
    }

    /**
     * Стартовое состояния
     *
     * @return string
     */
    public function actionGetUserFolders()
    {
        $client_id = htmlspecialchars($_GET['clientId']);

        $folders = Folders::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andFilterWhere(['client_id' => $client_id])
            ->asArray()
            ->all();

        return $this->render('start_folders', [
            'folders' => $folders,
        ]);
    }

    /**
     * [ajax] Создание новой директории
     *
     * @return bool
     */
    public function actionCreateDir()
    {
        $folder_name = htmlspecialchars($_GET['foldername']);
        $client_id   = htmlspecialchars($_GET['clientid']);

        $folder            = new Folders;
        $folder->user_id   = Yii::$app->user->id;
        $folder->parent_id = 0;
        $folder->name      = $folder_name;
        $folder->active    = 1;
        $folder->client_id = $client_id;
        $folder->order_id  = 0;
        $folder->save();

        return true;
    }

    /**
     * Загрузка файлов
     *
     * @return false|string
     */
    public function actionUploadFile()
    {


        $timestamp = time();
        $new_file_name = trim($_FILES['file']['name']);
        $new_file_name = str_replace(' ', "_", $new_file_name);
        $new_file_name = md5($new_file_name);
        $new_file_name = $timestamp . $new_file_name;

        $ext        = explode('.', $_FILES['file']['name']);
        $ext        = end($ext);
        $final_path = 'uploads/' . $new_file_name . '.' . $ext;

        move_uploaded_file($_FILES['file']['tmp_name'], $final_path);

        // 2. Добавление инфы в БД
        $new_file            = new UploadedFiles;
        $new_file->user_id   = Yii::$app->user->id;
        $new_file->client_id = (int)htmlspecialchars($_POST["clientid"]);
        $new_file->order_id  = 0;
        $new_file->folder_id = (int)htmlspecialchars($_POST["folderid"]);
        $new_file->filename  = $_FILES['file']['name'];
        $new_file->path      = $final_path;
        $new_file->save();

        // 3. Формирование массива на возврат
        $res = [
            'fileName' => $_FILES['file']['name'],
            'filePath' => $final_path,
        ];

        return json_encode($res);
    }
}