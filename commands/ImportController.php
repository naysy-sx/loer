<?php
namespace app\commands;

use app\models\db\CourtsAddresses;
use yii\console\Controller;

/**
 * Class HelloController
 * @package app\commands
 */
class ImportController extends Controller
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        $files_dir = 'public_html/import_files/courts';

        // получаем список файлов импорта
        $files = self::getAllFiles($files_dir);

        // перебираем каждый файл
        foreach ($files as $file_name) {
            if ($file_name == 'Реестр СОЮ-Tаблица 1.csv') {
                // полный путь до файла
                $cr_file = "{$files_dir}/$file_name";

                if (($handle = fopen($cr_file, "r")) !== false) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        $num = count($data);
                        for ($c = 0; $c < $num; $c++) {
                            $newcourts = new CourtsAddresses;
                            $newcourts->region = $data[1];
                            $newcourts->district = $data[2];
                            $newcourts->city = $data[3];
                            $newcourts->name = explode(';', $data[0])[2];
                            if (isset($data[4])){
                                $newcourts->address = $data[4];
                            }
                            if (isset($data[5])){
                                $newcourts->phone = $data[5];
                            }
                            $newcourts->save();

                            echo "\n\n .. сохранено \n\n";
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
}
