<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\db\CourtsAddresses;
use Yii;
use yii\web\Controller;

/**
 * Import. TODO !!! Перенесено в консоль TODO !!!
 * @package app\controllers
 */
class ImportController extends Controller
{
    public $layout = false;

    /**
     * Контроль доступа
     *
     * @param \yii\base\Action $action
     *
     * @return mixed
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        MainAccess::ifGuestGoHome();

        return parent::beforeAction($action);
    }

    /**
     * Новый импорт
     */
    public function actionIndex()
    {
        exit;
        $file = "../for_import/csv/cc_base.csv";

        $row = 1;
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    $tmp = null;

                    $tmp['region']    = $data[1];
                    $tmp['district']  = $data[2];
                    $tmp['city']      = '';
                    $tmp['name']      = $data[4];
                    $tmp['name_kem']  = $data[5];
                    $tmp['name_kogo'] = $data[6];
                    $tmp['address']   = $data[7];
                    $tmp['phone']     = $data[8];

                    $cc            = new CourtsAddresses;
                    $cc->region    = $tmp['region'];
                    $cc->district  = $tmp['district'];
                    $cc->city      = $tmp['district'];
                    $cc->name      = $tmp['name'];
                    $cc->name_kem  = $tmp['name_kem'];
                    $cc->name_kogo = $tmp['name_kogo'];
                    $cc->address   = $tmp['address'];
                    $cc->phone     = $tmp['phone'];
                    $cc->save();
                }
            }
            fclose($handle);
        }
    }

    /**
     * Старый импорт
     *
     * @return bool
     */
    public function actionOldIndex()
    {
        exit;
        $files_dir = 'import_files/courts';

        // получаем список файлов импорта
        $files = self::getAllFiles($files_dir);

        // перебираем каждый файл
        foreach ($files as $file_name) {
            if ($file_name == 'Реестр СОЮ-Tаблица 1.csv') {
                // полный путь до файла
                $cr_file = "{$files_dir}/$file_name";

                echo '<pre>';
                var_dump($file_name);
                echo '<br>';

                if (($handle = fopen($cr_file, "r")) !== false) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        $num = count($data);
                        for ($c = 0; $c < $num; $c++) {
                            var_dump($data);
                        }
                    }
                    fclose($handle);
                }

                echo '</pre>';
            }
        }

        return true;
    }

    /**
     * Получение списка файлов
     *
     * @return array
     */
    public static function getAllFiles($files_dir)
    {
        $scan  = scandir($files_dir);
        $files = [];

        foreach ($scan as $file) {
            if ($file != '.' && $file != '..') {
                $files[] = $file;
            }
        }

        return $files;
    }

    /**
     * Удаление повторов
     *
     * @return bool
     * @throws \yii\db\Exception
     */
    public function actionDelDouble()
    { exit;
        $first_datas  = CourtsAddresses::find()->asArray()->all();
        $clean_result = [];

        // собираем уникальные элементы
        foreach ($first_datas as $first_data) {
            $clean_result[$first_data['phone']] = $first_data;
        }

        // чистим базу
        Yii::$app->db->createCommand()->truncateTable('courts_addresses')->execute();

        // записываем уникальные элементы обратно в базу
        foreach ($clean_result as $court) {
            /** @var CourtsAddresses $new_court */
            $new_court            = new CourtsAddresses;
            $new_court->region    = $court['region'];
            $new_court->district  = $court['district'];
            $new_court->city      = $court['city'];
            $new_court->name      = $court['name'];
            $new_court->name_kem  = $court['name_kem'];
            $new_court->name_kogo = $court['name_kogo'];
            $new_court->address   = $court['address'];
            $new_court->phone     = $court['phone'];
            $new_court->save();
        }

        return true;
    }
}