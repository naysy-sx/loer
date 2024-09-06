<?php

namespace app\controllers;

use app\models\access\MainAccess;
use app\models\db\TmpDoc;
use Dompdf\Dompdf;
use Yii;
use yii\web\Controller;

/**
 * Генератор .pdf
 *
 * @package app\controllers
 */
class PdfCreatorController extends Controller
{

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

    public function actionDynamical()
    {
        $this->layout = false;
        $folder       = "../views/pdf-creator/";
        $client_id    = htmlspecialchars($_GET['client']);
        $doc_name     = htmlspecialchars($_GET['doc']); //  . '.php'

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'    => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => '435646545565',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_nezakonno' => 'Документ №1',

            'isk_podpis' => 'Ген. директор',
            'isk_shifr'  => 'Иванов И.И.',
        ];

        $html = $this->renderPartial($doc_name, [
            'data' => $data,
        ]);

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8'); // WIN-1251 / UTF-8
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();


        // 1. Если нужен редактор
                return $this->render('editor', [
                    'data'     => $data,
                    'doc_name' => $doc_name,
                ]);

        // 2. Вывод файла в браузер:
        //$dompdf->stream('test');

        // 3. Если нужно сохранение
        // Указываем, куда сохранить файл и сохраняем
//        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';
//        $pdf             = $dompdf->output();
//        file_put_contents($random_filename, $pdf);

        // редирект на созданный файл
//        return "<script>window.location.href='{$random_filename}'</script>";

        //        return $this->render($doc_name, [
        //            'data' => $data,
        //        ]);
    }

    /**
     * @return string
     */
    public function actionStart()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),
            'istec'            => "Василий Васильевич Васильев",
            'otvetchik'        => '',
        ];

        /** Шаблон */
        $html = $this->renderPartial('isk', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIsk()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),
            'istec'            => "Иванов Иван Иванович",
            'sud_address'      => "Невский пр д1",
            'istec_address'    => "Невский пр д1",
            'sud'              => "Советский районный суд",
            'sud_city'         => "Санкт-Путурбурга",
            'otvetchik'        => '',
        ];

        /** Шаблон */
        $html = $this->renderPartial('isk', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiZadolzhennostiPoAllimentam()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',
            'isk_price'    => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'            => 'Суда преображенского района',
            'delo_date'           => '16.12.1888',
            'delo_number'         => '12345',
            'child_fio'           => 'Ивановой Марии Ивановны',
            'child_birth'         => '1223',
            'child_aliments'      => '12345',
            'delo_ispolnenie'     => 'Преображенском суде',
            'delo_proizvodstvo'   => '123',
            'delo_periodot'       => '14.23.1234',
            'delo_perioddo'       => '14.23.1235',
            'delo_zadolzhennost'  => '34523',
            'delo_podtverzhdenie' => 'Документом №1',
            'delo_rashody'        => '3456',

            'delo_dop'      => 'обучения',
            'delo_dopsumma' => '1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-zadolzhennosti-po-allimentam', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObYstanovleniiFactaPriznaniyaOtsovtstva()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'zainteresovannoelitso_fio'   => 'Иванов Иван Петрович',
            'zainteresovannoelitso_phone' => '+79215836465',
            'zainteresovannoelitso_email' => 'surname@mail.ru',

            'isk_poshlina' => '3000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'otets_fio'           => 'Иванов Иван Сергеевич',
            'delo_date'           => '16.12.1888',
            'delo_address'        => 'г. Восток, Новая ул., д.30, кв.3',
            'child_birth_day'     => '12',
            'child_birth_month'   => 'декабря',
            'child_birth_year'    => '1236',
            'child_fio'           => 'Иванова Мария Ивановна',
            'delo_dlya'           => 'получения пенсии',
            'delo_podtverzhdenie' => 'Петров П.П.',

            'otets_birth' => '45.45.4545',
            'otets_place' => 'г. Восток',
            'child_birth' => '12.12.1234',
            'child_place' => 'г. Восток',

            'delo_obyazat' => 'Иванов Иван Сергеевич',
            'child_new'    => 'Петров',
            'otets_new'    => 'Петров Петр Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-ystanovlenii-facta-priznaniya-otsovtstva', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieORastorzheniiBrakaIRazdeleImyschestva()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',
            'isk_price'    => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'   => '16',
            'brak_date_month' => 'декабря',
            'brak_date_year'  => '1888',
            'brak_seria'      => '12345',
            'brak_number'     => '12345',
            'brak_act'        => '122',
            'brak_start'      => '2018',
            'brak_end'        => '2019',
            'brak_prichina'   => 'шизофренией',
            'brak_address'    => 'г. Восток, Новая ул. д.12, кв.3',
            'brak_date'       => '16.12.1222',
            'istec_birth'     => '16.12.1222',

            'istec_videlyt'      => 'компенсацию',
            'istec_price'        => '12300',
            'otvetchick_videlyt' => 'компенсацию',
            'otvetchick_price'   => '12300',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-rastorzhenii-braka-i-razdele-imyschestva', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOPriznaniiBrakaNedeistvitelnim()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',
            'isk_price'    => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'   => '16',
            'brak_date_month' => 'декабря',
            'brak_date_year'  => '1888',
            'brak_seria'      => '12345',
            'brak_number'     => '12345',
            'brak_act'        => '122',
            'brak_start'      => '2018',
            'brak_prichina'   => 'дела случаются',
            'brak_date'       => '16.12.1222',
            'brak_zags'       => 'Районным ЗАГСом',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-priznanii-braka-nedeistvitelnim', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieORazdeleImyschestvaPosleRazvoda()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',
            'isk_price'    => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_prichina' => 'дела случаются',
            'brak_start'    => '16.12.1222',
            'brak_end'      => '16.12.1222',
            'brak_factend'  => '16.12.1222',
            'brak_razdelit' => 'по половине',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-razdele-imyschestva-posle-razvoda', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieORaztorzheniiBraka()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'   => '16',
            'brak_date_month' => 'декабря',
            'brak_date_year'  => '1888',
            'brak_seria'      => '12345',
            'brak_number'     => '12345',
            'brak_act'        => '122',
            'brak_end'        => '16.12.1222',
            'child_fio'       => 'Иванов Иван Иванович',
            'brak_rastorgnut' => 'по половине',
            'istec_birth'     => '16.12.1222',
            'brak_date'       => '16.12.1222',
            'brak_sud'        => 'ЗАГСе',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-raztorzhenii-braka', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieORaztorzheniiBrachnogoDogovora()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'     => '16',
            'brak_date_month'   => 'декабря',
            'brak_date_year'    => '1888',
            'brak_seria'        => '12345',
            'brak_number'       => '12345',
            'brak_act'          => '122',
            'dogovor_date'      => '12.23.2311',
            'dogovor_number'    => '14441',
            'dogovor_uslovia'   => 'дела случаются',
            'dogovor_izmenenie' => 'дела случились',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-raztorzhenii-brachnogo-dogovora', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVidacheSudebnogoPrikazaOVziskaniiAllimentov()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'vziskatel_fio'     => 'Иванов Иван Иванович',
            'vziskatel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'vziskatel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'vziskatel_phone'   => '+79215836465',
            'vziskatel_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'dolzhnick_fio'             => 'Иванов Иван Петрович',
            'dolzhnick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'dolzhnick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'dolzhnick_birth_date'      => '16.12.1888',
            'dolzhnick_birth_place'     => 'г. Восток',
            'dolzhnick_passport_seria'  => '2020',
            'dolzhnick_passport_number' => '234567',
            'dolzhnick_passport_vydan'  => '2012',
            'dolzhnick_passport_code'   => '230-230',
            'dolzhnick_phone'           => '+79215836465',
            'dolzhnick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'   => '16',
            'brak_date_month' => 'декабря',
            'brak_date_year'  => '1888',
            'brak_seria'      => '12345',
            'brak_number'     => '12345',
            'brak_act'        => '122',
            'child_fio'       => 'Иванов Иван Иванович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vidache-sudebnogo-prikaza-o-vziskanii-allimentov', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObOpredeleniiDoleiSuprugovNaKvartiru()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_date_day'     => '16',
            'brak_date_month'   => 'декабря',
            'brak_date_year'    => '1888',
            'brak_seria'        => '12345',
            'brak_number'       => '12345',
            'brak_act'          => '122',
            'kvartira_name'     => 'трехкомнатную квартиру',
            'kvartira_address'  => 'г. Восток, Новая ул., д.123, кв.2',
            'kvartira_ploschad' => '123 м2',
            'kvartira_number'   => '1234',
            'kvartira_poryadok' => 'по половине',

            'istec_dolya'      => '12345 руб.',
            'otvetchick_dolya' => '12345 руб.',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-opredelenii-dolei-suprugov-na-kvartiru', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVosstanovleniiRoditelskihPrav()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'       => 'Преображенского суда',
            'delo_date'      => '12.12.1222',
            'child_fio'      => 'Иванов Иван Иванович',
            'child_birth'    => '12.12.1222',
            'delo_prichina'  => 'безработицей',
            'delo_izmenenie' => 'нашел работу',
            'istec_birth'    => '12.12.1222',
            'istec_place'    => 'г. Восток',

            'istec_dolya'      => '12345 руб.',
            'otvetchick_dolya' => '12345 руб.',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vosstanovlenii-roditelskih-prav', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObOpredeleniiMestaZhitelstvaRebenka()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'tretje_fio' => 'Иванов Иван Петрович',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_start'        => '12.12.1222',
            'brak_end'          => '12.12.1222',
            'child_fio'         => 'Иванов Иван Иванович',
            'child_birth'       => '12.12.1222',
            'child_prozhivaets' => 'Иванов Иван Иванович',
            'delo_prichina'     => 'безработицей',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-opredelenii-mesta-zhitelstva-rebenka', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiAlimentovVTverdoiDenezhnoiSumme()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_fio'       => 'Иванов Иван Иванович',
            'child_birth'     => '12.12.1222',
            'brak_status'     => 'расторгнут',
            'alim_territoria' => 'Ярославской области',
            'alim_minimum'    => '15000',
            'alim_summa'      => '5000',
            'child_rashody'   => '25000',
            'child_age'       => '5 лет',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-alimentov-v-tverdoi-denezhnoi-summe', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObOgranicheniiRoditelskihPrav()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'tretje_fio' => 'Иванов Иван Петрович',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_fio'        => 'Иванов Иван Иванович',
            'child_birth'      => '12.12.1222',
            'child_narushenie' => 'нарушение среды обитания',
            'child_alim'       => '1234 рублей',
            'child_address'    => 'г. Восток, Новая ул., д.13, кв.2',
            'child_nasledstvo' => 'дома',
            'child_contact'    => '2 через 2',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-ogranichenii-roditelskih-prav', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObOsparivaniiOtsovstva()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_fio'           => 'Иванов Иван Иванович',
            'child_birth'         => '12.12.1222',
            'istec_status'        => 'матерью',
            'otvetchick_status'   => 'пьет',
            'delo_prepyatstvie'   => 'поездке заграницу',
            'svidetelstvo_number' => '12312',
            'svidetelstvo_date'   => '12.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-osparivanii-otsovstva', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObUstanovleniiOtsovstva()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'brak_start'        => '12.12.1234',
            'brak_status'       => 'браке',
            'brak_status2'      => 'расторгнут',
            'child_birth_day'   => '12',
            'child_birth_month' => 'декабря',
            'child_birth_year'  => '1234',
            'brak_facts'        => 'дела случаются',
            'otvetchick_place'  => 'г. Восток',
            'child_birth'       => '12.12.1234',
            'child_fio'         => 'Иванов Иван Иванович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-ustanovlenii-otsovstva', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOLisheniiRoditelskihPrav()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'tretje_fio' => 'Иванов Иван Петрович',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'otvetchick_status' => 'отцом',
            'child_birth'       => '12.12.1234',
            'child_fio'         => 'Иванов Иван Иванович',
            'otvetchick_facts'  => 'пьет',
            'child_narushenie'  => 'ограничении',
            'child_birth_day'   => '12',
            'child_birth_month' => 'декабря',
            'child_birth_year'  => '1234',
            'child_prozhivaet'  => 'с отцом',
            'child_address'     => 'г. Восток, ул. Новая, д.12, кв.3',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-lishenii-roditelskih-prav', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiAllimentov()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_birth' => '12.12.1234',
            'child_fio'   => 'Иванов Иван Иванович',
            'brak_status' => 'расторгнут',

            'otvetchick_place' => 'Газпром',
            'otvetchick_inn'   => '233423423423',
            'otvetchick_work'  => 'инженера',
            'child_alim'       => '20%',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-allimentov', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieObUmensheniiRazmeraAllimetov()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'isk_poshlina' => '5000',
            'isk_price'    => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_birth'         => '12.12.1234',
            'child_fio'           => 'Иванов Иван Иванович',
            'delo_day'            => '12',
            'delo_month'          => 'декабря',
            'delo_year'           => '1234',
            'delo_kem'            => 'районным судом',
            'delo_osnovanie'      => 'Документа №1',
            'child_alim'          => '12345 руб.',
            'delo_vinesenie'      => 'постановления',
            'delo_obstoyatelstva' => 'дела случаются',
            'delo_smenya'         => 'Иванов Иван Сергеевич',
            'delo_poresheniy'     => 'суда',
            'delo_number'         => '1234',
            'delo_do'             => 'совершеннолетия',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-ob-umenshenii-razmera-allimetov', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiAllimentovNaSoderzhanieRoditelei()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_birth'     => '12.12.1234',
            'child_fio'       => 'Иванов Иван Иванович',
            'delo_dohod'      => 'пенсии',
            'delo_summa'      => '1234',
            'delo_zatraty'    => '1234 руб.',
            'delo_dolya'      => '20%',
            'delo_territoria' => 'Ярославской области',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-allimentov-na-soderzhanie-roditelei', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieODopolnitelnihRashodovNaRebenka()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_birth'    => '12.12.1234',
            'child_fio'      => 'Иванов Иван Иванович',
            'delo_day'       => '12',
            'delo_month'     => 'декабря',
            'delo_year'      => '1234',
            'delo_kem'       => 'районным судом',
            'delo_osnovanie' => 'Документа №1',
            'child_alim'     => '12345 руб.',
            'delo_pricina'   => 'дела случаются',
            'delo_doprashod' => 'обучение',
            'delo_vziskat'   => 'три козы',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-dopolnitelnih-rashodov-na-rebenka', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiAllimentovNaSoverhennoletnego()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'child_birth'          => '12.12.1234',
            'child_fio'            => 'Иванов Иван Иванович',
            'brak_status'          => 'распался',
            'child_pricina'        => 'раком',
            'child_podtverzhdenie' => 'Документом №1',
            'child_rashod'         => '12345',
            'child_alim'           => '12345',
            'child_mrot'           => 'минимального',
            'delo_territoria'      => 'Ярославской области',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-allimentov-na-soverhennoletnego', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionIskovoeZayavlenieOVziskaniiNeystoikiPoAllimentam()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'             => 'Иванов Иван Петрович',
            'otvetchick_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'            => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_birth_date'      => '16.12.1888',
            'otvetchick_birth_place'     => 'г. Восток',
            'otvetchick_passport_seria'  => '2020',
            'otvetchick_passport_number' => '234567',
            'otvetchick_passport_vydan'  => '2012',
            'otvetchick_passport_code'   => '230-230',
            'otvetchick_phone'           => '+79215836465',
            'otvetchick_email'           => 'surname@mail.ru',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'    => '10',
            'delo_month'  => 'декабря',
            'delo_year'   => '1988',
            'delo_kem'    => 'Районного суда',
            'delo_number' => '1234',
            'child_kto'   => 'Иванов Иван Иванович',
            'child_alim'  => '1234 руб.',
            'delo_year'   => '1995',
            'delo_dolg'   => '1995',
            'delo_summa'  => '19954 руб.',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('iskovoe-zayavlenie-o-vziskanii-neystoiki-po-allimentam', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOPeresmotreDelaPoVnovOtkryvshimsaObstoyatelstvam()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'              => '10',
            'delo_month'            => 'декабря',
            'delo_year'             => '1988',
            'delo_sud'              => 'Районный суд',
            'delo_vineseno'         => 'обвинение',
            'delo_number2'          => '12345',
            'delo_soglasnokotoromy' => 'дела случаются',
            'delo_peresmotret'      => 'обстоятельства',
            'delo_isk'              => 'пятому',
            'delo_o'                => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-peresmotre-dela-po-vnov-otkryvshimsa-obstoyatelstvam', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOSostavleniiMotivirovannogoReshenia()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'              => '10',
            'delo_month'            => 'декабря',
            'delo_year'             => '1988',
            'delo_sud'              => 'Районный суд',
            'delo_number2'          => '12345',
            'delo_soglasnokotoromy' => 'дела случаются',
            'delo_isk'              => 'пятому',
            'delo_o'                => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-sostavlenii-motivirovannogo-reshenia', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObOtmeneZaochnogoReshenia()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'              => '10',
            'delo_month'            => 'декабря',
            'delo_year'             => '1988',
            'delo_sud'              => 'Районный суд',
            'delo_number2'          => '12345',
            'delo_soglasnokotoromy' => 'дела случаются',
            'polychenie_day'        => '12',
            'polychenie_month'      => 'декабря',
            'polychenie_year'       => '1988',
            'delo_pricina'          => 'пил',
            'delo_pricina2'         => 'пил много',
            'delo_dokazatelstva'    => 'дела случаются',
            'delo_isk'              => 'пятому',
            'delo_o'                => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',

        ];

        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-otmene-zaochnogo-reshenia', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionOtzyvNaIskovoeZayavlenie()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'        => 'Районный суд',
            'delo_isk'        => 'пятому',
            'delo_k'          => 'Иванов Иван Петрович',
            'delo_o'          => 'дела случаются',
            'delo_osnovania'  => 'дела случаются',
            'delo_number2'    => '12345',
            'delo_trebovania' => 'не шалить',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('otzyv-na-iskovoe-zayavlenie', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoORassmotreniiDelaVOtsutstvieIstcaOtvetchika()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_isk'     => 'пятому',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_date'    => '14.15.2333',
            'delo_pricina' => 'пью',
            'delo_number2' => '12345',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-rassmotrenii-dela-v-otsutstvie-istca-otvetchika', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObOtkazeOtIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятому',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_pricina'     => 'дела случаются',
            'delo_trebovaniya' => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-otkaze-ot-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOPerenoseSudebnogoZasedania()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_isk'     => 'пятому',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_date'    => '14.15.2333',
            'delo_yavitsa' => 'Иванов Иван Петрович',
            'delo_pricina' => 'дела случаются',
            'delo_number2' => '12345',
            'delo_srok'    => '2 года',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-perenose-sudebnogo-zasedania', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObOsvobozhdeniiOtUplatyGosposhlini()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'      => 'Районный суд',
            'delo_o'        => 'дела случаются',
            'delo_poshlina' => '2345',
            'delo_pricina'  => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-osvobozhdenii-ot-uplaty-gosposhlini', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVziskaniiRashodovNaOplatyUslugPredstavitela()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'            => '10',
            'delo_month'          => 'декабря',
            'delo_year'           => '1988',
            'delo_sud'            => 'Районный суд',
            'delo_isk'            => 'пятому',
            'delo_k'              => 'Иванов Иван Петрович',
            'delo_o'              => 'дела случаются',
            'delo_obrasheniek'    => 'Иванов Иван Петрович',
            'dogovor_day'         => '10',
            'dogovor_month'       => 'декабря',
            'dogovor_year'        => '1988',
            'dogovor_number'      => '19883',
            'dogovor_uslugi'      => 'помощь',
            'delo_number2'        => '1234',
            'delo_rabota'         => 'помощь',
            'delo_summa'          => '1234',
            'delo_podtverzhdenie' => 'Документом №1',
            'vziskat_s'           => 'Иванов Иван Петрович',
            'vziskat_k'           => 'Иванов Иван Петрович',
            'delo_date'           => '10.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vziskanii-rashodov-na-oplaty-uslug-predstavitela', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObUmensheniiRazmeraGosposhlini()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'        => 'Районный суд',
            'delo_k'          => 'Иванов Иван Петрович',
            'delo_o'          => 'дела случаются',
            'delo_poshlina'   => '1234',
            'delo_pricina'    => 'дела случаются',
            'delo_oplacheno'  => '1234',
            'delo_zayavlenie' => 'об изменении',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-umenshenii-razmera-gosposhlini', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVziskaniiSudebnihRashodov()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'            => '10',
            'delo_month'          => 'декабря',
            'delo_year'           => '1988',
            'delo_sud'            => 'Районный суд',
            'delo_isk'            => 'пятому',
            'delo_k'              => 'Иванов Иван Петрович',
            'delo_o'              => 'дела случаются',
            'delo_ponesizderzhki' => 'Иванов Иван Петрович',
            'delo_izderzhki'      => 'кровать, диван, матрас',
            'delo_rashody'        => '12345',
            'delo_number2'        => '12345',
            'delo_vziskats'       => 'Иванов Иван Петрович',
            'delo_vziskatk'       => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vziskanii-sudebnih-rashodov', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOZakrytomSudebnomZasedanii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_isk'          => 'пятому',
            'delo_k'            => 'Иванов Иван Петрович',
            'delo_o'            => 'дела случаются',
            'delo_date'         => '12.12.1234',
            'delo_dannie'       => 'документы',
            'delo_number2'      => '12345',
            'delo_pozayavleniy' => 'о делах',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-zakrytom-sudebnom-zasedanii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVozvrasheniiApellatsionnoiZhaloby()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'              => '10',
            'delo_month'            => 'декабря',
            'delo_year'             => '1988',
            'delo_sud'              => 'Районный суд',
            'delo_vynesenno'        => 'решение',
            'delo_number2'          => '12345',
            'delo_soglasnokotoromy' => 'дела случаются',
            'appelatsya_day'        => '10',
            'appelatsya_month'      => 'декабря',
            'appelatsya_year'       => '1988',
            'appelatsya_kem'        => 'Иванов Иван Петрович',
            'appelatsya_kto'        => 'Иванов Иван Петрович',
            'appelatsya_pricina'    => 'дела случаются',
            'zhaloba_ot'            => 'Иванов Иван Петрович',
            'zhaloba_na'            => 'Иванов Иван Петрович',
            'delo_isk'              => 'пятому',
            'delo_k'                => 'Иванов Иван Петрович',
            'delo_o'                => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vozvrashenii-apellatsionnoi-zhaloby', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOPriostanovleniiRassmotreniaDela()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'           => 'Районный суд',
            'delo_isk'           => 'пятому',
            'delo_k'             => 'Иванов Иван Петрович',
            'delo_o'             => 'дела случаются',
            'appelatsya_kto'     => 'Иванов Иван Петрович',
            'appelatsya_pricina' => 'дела случаются',
            'delo_number2'       => '12345',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-priostanovlenii-rassmotrenia-dela', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieONemedlennomIspolneniiResheniaSuda()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_delo'         => 'пятому',
            'delo_k'            => 'Иванов Иван Петрович',
            'delo_o'            => 'дела случаются',
            'appelatsya_kto'    => 'Иванов Иван Петрович',
            'appelatsya_kchemy' => 'дела случаются',
            'delo_sud2'         => 'Районный суд',
            'delo_date'         => '12.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-nemedlennom-ispolnenii-reshenia-suda', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObIspravleniiNedostatkovIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_date'        => '12.12.1234',
            'delo_isk'         => 'пятоe',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_do'          => '12.12.1234',
            'delo_pricina'     => 'дела случаются',
            'delo_kto'         => 'Иванов Иван Петрович',
            'delo_neobhodimo'  => 'пить',
            'delo_kzayavleniu' => 'два',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-ispravlenii-nedostatkov-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVozvrasheniiIskovogoZayavlenia()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'     => '10',
            'delo_month'   => 'декабря',
            'delo_year'    => '1988',
            'delo_sud'     => 'Районный суд',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_pricina' => 'дела случаются',
            'delo_isk'     => 'пятое',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vozvrashenii-iskovogo-zayavlenia', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObIspravleniiOpiskiVResheniiSuda()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'            => '10',
            'delo_month'          => 'декабря',
            'delo_year'           => '1988',
            'delo_sud'            => 'Районный суд',
            'delo_number2'        => '193488',
            'delo_opicanie'       => 'дела случаются',
            'delo_oshibki'        => 'не указана дата',
            'delo_pravilno'       => 'указанная дата',
            'delo_podtverzhdenie' => 'глазами',
            'delo_date'           => '10.12.2134',
            'delo_vmesto'         => 'пусты',
            'delo_ukazat'         => 'дату',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-ispravlenii-opiski-v-reshenii-suda', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoODopolnitelnomReshenii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'         => '10',
            'delo_month'       => 'декабря',
            'delo_year'        => '1988',
            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятое',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_soderzhanie' => 'дела случаются',
            'delo_nesoglasie'  => 'дела случаются',
            'delo_number2'     => '193488',
            'delo_voprosy'     => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-dopolnitelnom-reshenii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieORassrochkeGosudarstvennoiPoshlini()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'      => 'Районный суд',
            'delo_k'        => 'Иванов Иван Петрович',
            'delo_o'        => 'дела случаются',
            'delo_cena'     => '12345',
            'delo_poshlina' => '12345',
            'delo_pricina'  => 'дела случаются',
            'delo_mesaci'   => '12',
            'delo_po'       => '1234',
            'delo_isk'      => 'пятое',
            'delo_srok'     => '12.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-rassrochke-gosudarstvennoi-poshlini', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOZacheteGosposhlini()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'            => 'Районный суд',
            'delo_k'              => 'Иванов Иван Петрович',
            'delo_o'              => 'дела случаются',
            'delo_cena'           => '12345',
            'delo_poshlina'       => '12345',
            'delo_date'           => '12.12.1234',
            'delo_date2'          => '12.12.1234',
            'delo_podtverzhdenie' => 'дела случаются',
            'delo_date3'          => '12.12.1234',
            'kvitancia_ot'        => '12.12.1234',
            'kvitancia_number'    => '123',
            'delo_isk'            => 'дела случаются',
            'delo_opredelenie'    => 'дела случаются',
            'delo_sud2'           => 'Районным суд',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-zachete-gosposhlini', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVozvrateGosudarstvenoiPoshlini()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_poshlina'    => '12345',
            'delo_pricina'     => 'дела случаются',
            'delo_date'        => '12.12.1234',
            'kvitancia_ot'     => '12.12.1234',
            'kvitancia_number' => '123',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vozvrate-gosudarstvenoi-poshlini', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOPeredacheDelaPoPodsudnosti()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'        => 'Районный суд',
            'delo_k'          => 'Иванов Иван Петрович',
            'delo_o'          => 'дела случаются',
            'delo_isk'        => 'пятому',
            'delo_kto'        => 'Иванов Иван Петрович',
            'delo_peredachav' => 'Районный суд',
            'delo_pricina'    => 'дела случаются',
            'delo_number2'    => '1234',
            'delo_podsudnost' => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-peredache-dela-po-podsudnosti', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObOznakomleniiSMaterialamiDela()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_isk'     => 'пятому',
            'delo_kto'     => 'Иванов Иван Петрович',
            'delo_number2' => '1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-oznakomlenii-s-materialami-dela', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObObespecheniiIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_fact'        => 'дела случаются',
            'delo_isk'         => 'пятому',
            'delo_imuschestvo' => 'кровать, матрас, диван',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-obespechenii-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoODopolnitelnihDokazatelstvah()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'            => 'Районный суд',
            'delo_isk'            => 'пятому',
            'delo_k'              => 'Иванов Иван Петрович',
            'delo_o'              => 'дела случаются',
            'delo_obstoyatelstva' => 'дела случаются',
            'delo_documents'      => 'Документ №1',
            'delo_number2'        => '12345',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-dopolnitelnih-dokazatelstvah', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOPriobscheniiDocumentovKMaterialamDela()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'       => 'Районный суд',
            'delo_isk'       => 'пятому',
            'delo_k'         => 'Иванов Иван Петрович',
            'delo_o'         => 'дела случаются',
            'delo_documents' => 'Документ №1',
            'delo_number2'   => '12345',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-priobschenii-documentov-k-materialam-dela', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionVozrazhenieNaEkspertizy()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятому',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_day'         => '10',
            'delo_month'       => 'декабря',
            'delo_year'        => '1988',
            'delo_zakluchenie' => 'Документ №1',
            'delo_rezultat'    => 'дела случаются',
            'delo_osnovania'   => 'дела случаются',
            'delo_number2'     => '12345',
            'delo_date'        => '12.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('vozrazhenie-na-ekspertizy', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVizoveEkspertaNaSudebnoeZasedanie()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятому',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_day'         => '10',
            'delo_month'       => 'декабря',
            'delo_year'        => '1988',
            'delo_zakluchenie' => 'Документ №1',
            'delo_rezultat'    => 'дела случаются',
            'delo_voprosy'     => 'дела случаются',
            'delo_ekspert'     => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vizove-eksperta-na-sudebnoe-zasedanie', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieNaProvedenieEkspertizi()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'        => 'Районный суд',
            'delo_isk'        => 'пятому',
            'delo_k'          => 'Иванов Иван Петрович',
            'delo_o'          => 'дела случаются',
            'delo_ustanovit'  => 'Документ №1',
            'delo_ekspertiza' => 'дела случаются',
            'delo_voprosy'    => 'дела случаются',
            'delo_komy'       => 'Иванов Иван Петрович',
            'delo_number2'    => '19828',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-na-provedenie-ekspertizi', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOVosstanovleniiSrokaIskovoiDavnosti()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'      => 'Районный суд',
            'delo_isk'      => 'пятому',
            'delo_k'        => 'Иванов Иван Петрович',
            'delo_o'        => 'дела случаются',
            'delo_izvestno' => 'недавно',
            'delo_pricina'  => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-vosstanovlenii-sroka-iskovoi-davnosti', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionYtochnenieIskovihTrebovanii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'        => 'Районный суд',
            'delo_isk'        => 'пятому',
            'delo_k'          => 'Иванов Иван Петрович',
            'delo_o'          => 'дела случаются',
            'delo_trebovania' => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('ytochnenie-iskovih-trebovanii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObOtvodeSudii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_isk'     => 'пятому',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_sudia'   => 'Иванов Иван Петрович',
            'delo_pricina' => 'дела случаются',
            'delo_number2' => '1234',
            'delo_number3' => '12434',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-otvode-sudii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOPrivlecheniiTretjegoLitsa()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'   => 'Районный суд',
            'delo_isk'   => 'пятому',
            'delo_k'     => 'Иванов Иван Петрович',
            'delo_o'     => 'дела случаются',
            'delo_prava' => 'дела случаются',
            'delo_chast' => '12.1',
            'delo_kto'   => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-privlechenii-tretjego-litsa', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOZameneOtvetchika()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_isk'     => 'пятому',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_pricina' => 'дела случаются',
            'delo_kto'     => 'Иванов Иван Петрович',
            'delo_zamenit' => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-zamene-otvetchika', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObUmensheniiIskohivTrebovanii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'       => 'Районный суд',
            'delo_isk'       => 'пятому',
            'delo_k'         => 'Иванов Иван Петрович',
            'delo_o'         => 'дела случаются',
            'delo_cena'      => '1234 рублей',
            'delo_pricina'   => 'дела случаются',
            'date_number2'   => '19882',
            'vziskat_s'      => 'Иванов Иван Петрович',
            'vziskat_komy'   => 'Иванов Иван Петрович',
            'vziskat_razmer' => '12345 рублей',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-umenshenii-iskohiv-trebovanii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObUvelicheniiIskovihTrebovanii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'       => 'Районный суд',
            'delo_isk'       => 'пятому',
            'delo_k'         => 'Иванов Иван Петрович',
            'delo_o'         => 'дела случаются',
            'delo_cena'      => '1234 рублей',
            'delo_pricina'   => 'дела случаются',
            'date_number2'   => '19882',
            'vziskat_s'      => 'Иванов Иван Петрович',
            'vziskat_komy'   => 'Иванов Иван Петрович',
            'vziskat_razmer' => '12345 рублей',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-uvelichenii-iskovih-trebovanii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieObUtverzdeniiMirovogoSoglashenia()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'     => 'Районный суд',
            'delo_isk'     => 'пятому',
            'delo_k'       => 'Иванов Иван Петрович',
            'delo_o'       => 'дела случаются',
            'delo_uslovia' => 'дела случаются',
            'delo_number2' => '19882',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-ob-utverzdenii-mirovogo-soglashenia', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZayavlenieOPriznaniiIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud' => 'Районный суд',
            'delo_isk' => 'пятому',
            'delo_k'   => 'Иванов Иван Петрович',
            'delo_o'   => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zayavlenie-o-priznanii-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObIzmeneniiPredmetaIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятому',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_ustanovleno' => 'дела случаются',
            'delo_new'         => 'дела случаются',
            'delo_izmenenia'   => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-izmenenii-predmeta-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObIzmeneniiOsnovaniiIska()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'         => 'Районный суд',
            'delo_isk'         => 'пятому',
            'delo_k'           => 'Иванов Иван Петрович',
            'delo_o'           => 'дела случаются',
            'delo_ustanovleno' => 'дела случаются',
            'delo_new'         => 'дела случаются',
            'delo_number2'     => '19488',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-izmenenii-osnovanii-iska', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVizoveSvideteleiGrazhdanskoePravo()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'            => 'Районный суд',
            'delo_isk'            => 'пятому',
            'delo_k'              => 'Иванов Иван Петрович',
            'delo_o'              => 'дела случаются',
            'delo_obstoyatelstva' => 'дела случаются',
            'delo_schitaet'       => 'Иванов Иван Петрович',
            'delo_svideteli'      => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vizove-svidetelei-grazhdanskoe-pravo', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVidacheSudebnogoActaIIspolnitelnogoLista()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'   => 'Районный суд',
            'delo_isk'   => 'пятому',
            'delo_k'     => 'Иванов Иван Петрович',
            'delo_o'     => 'дела случаются',
            'delo_day'   => '10',
            'delo_month' => 'декабря',
            'delo_year'  => '1988',
            'delo_email' => 'surname@mail.ru',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vidache-sudebnogo-acta-i-ispolnitelnogo-lista', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionAppelatsionnaiaZhaloba()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia2' => "Вторая инстанция",
            'sud_instancia1' => "Первая инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_pricina'   => 'дела случаются',
            'delo_sud'       => 'Районный суд',
            'delo_isk'       => 'пятому',
            'delo_k'         => 'Иванов Иван Петрович',
            'delo_o'         => 'дела случаются',
            'delo_kto'       => 'Иванов Иван Петрович',
            'delo_osnovania' => 'дела случаются',
            'delo_new'       => 'дела случаются',
            'delo_day'       => '10',
            'delo_month'     => 'декабря',
            'delo_year'      => '1988',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('appelatsionnaia-zhaloba', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionVozrazheniaNaAppelatstionnuyZhaloby()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia2' => "Вторая инстанция",
            'sud_instancia1' => "Первая инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_pricina'   => 'дела случаются',
            'delo_sud'       => 'Районный суд',
            'delo_isk'       => 'пятому',
            'delo_k'         => 'Иванов Иван Петрович',
            'delo_o'         => 'дела случаются',
            'delo_sud2'      => 'Районный суд',
            'delo_kto'       => 'Иванов Иван Петрович',
            'delo_zayavleno' => 'дела случаются',
            'delo_osnovania' => 'дела случаются',
            'delo_day'       => '10',
            'delo_month'     => 'декабря',
            'delo_year'      => '1988',
            'delo_number2'   => '19883',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('vozrazhenia-na-appelatstionnuy-zhaloby', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionKassacionnayaZhalobaGrazhdanskoePravo()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia2' => "Вторая инстанция",
            'sud_instancia1' => "Первая инстанция",
            'sud_instancia3' => "Третья инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_zhaloba'      => 'дела случаются',
            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_sud2'         => 'Районный суд',
            'delo_isk'          => 'пятому',
            'delo_k'            => 'Иванов Иван Петрович',
            'delo_o'            => 'дела случаются',
            'delo_day2'         => '10',
            'delo_month2'       => 'декабря',
            'delo_year2'        => '1988',
            'delo_opredeleniye' => 'дела случаются',
            'delo_schem'        => 'дела случаются',
            'delo_pricina'      => 'дела случаются',
            'delo_appelatsiya'  => 'дела случаются',
            'delo_ostavit'      => 'дела случаются',

            'delo_number2' => '19883',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('kassacionnaya-zhaloba-grazhdanskoe-pravo', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionVozrazheniaNaKassacionnyyZhaloby()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia2' => "Вторая инстанция",
            'sud_instancia1' => "Первая инстанция",
            'sud_instancia3' => "Третья инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'zainteresovannoe_fio'     => 'Иванов Иван Петрович',
            'zainteresovannoe_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'tretje_fio'     => 'Иванов Иван Петрович',
            'tretje_address' => 'г. Восток, Новая ул., д.30, кв.3',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_isk'          => 'пятому',
            'delo_k'            => 'Иванов Иван Петрович',
            'delo_o'            => 'дела случаются',
            'delo_day2'         => '10',
            'delo_month2'       => 'декабря',
            'delo_year2'        => '1988',
            'delo_opredeleniye' => 'дела случаются',
            'delo_pricina'      => 'дела случаются',
            'delo_appelatsiya'  => 'дела случаются',

            'delo_number2' => '19883',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('vozrazhenia-na-kassacionnyy-zhaloby', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObOtlozheniiSudebnogoZasedania()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_date'         => '12.12.1234',
            'delo_pricina'      => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-otlozhenii-sudebnogo-zasedania', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVizoveSvideteleiAdministrativnoePravo()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_svidetel'     => 'Иванов Иван Петрович',
            'delo_pricina'      => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vizove-svidetelei-administrativnoe-pravo', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObIstrebovaniiDokazatelstv()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_istrebovat'   => 'Документ №1',
            'delo_pricina'      => 'дела случаются',
            'delo_istrebovatiz' => 'Документ №1',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-istrebovanii-dokazatelstv', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoORassmotreniiDelaVOtsutstvieLitsaUchastvyuschegoVDeleObAdministrativnomPravonarushenii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_pricina'      => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html =
            $this->renderPartial('hodataistvo-o-rassmotrenii-dela-v-otsutstvie-litsa-uchastvyuschego-v-dele-ob-administrativnom-pravonarushenii',
                [
                    'data' => $data,
                ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoODopuskeZaschitnika()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_zaschitnik'   => 'Иванов Иван Петрович',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-dopuske-zaschitnika', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOPrekrascheniiDelaPoMaloznachitelnosti()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_osnovanii'    => 'дела случаются',
            'delo_po'           => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-prekraschenii-dela-po-maloznachitelnosti', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOPriobscheniiDokazatelstv()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_svedenia'     => 'дела случаются',
            'delo_documents'    => 'Доркумент №1',
            'delo_number2'      => '14988',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-priobschenii-dokazatelstv', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObOznakomleniiSMaterialamiDelaIOtlozheniiSudebnogoZasedania()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_date'         => '14.14.1423',
            'delo_number2'      => '14988',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html =
            $this->renderPartial('hodataistvo-ob-oznakomlenii-s-materialami-dela-i-otlozhenii-sudebnogo-zasedania', [
                'data' => $data,
            ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOPeredacheDelaDlyaRassmotreniaPoMestyZhitelstva()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_address'      => 'г. Восток, Новая ул., д.35, кв.3',
            'delo_v'            => 'Районный суд',
            'delo_number2'      => '11988',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-peredache-dela-dlya-rassmotrenia-po-mesty-zhitelstva', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVizoveIDoprosePonyatih()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_ponyatoi'     => 'Иванов Иван Петрович',
            'delo_pricina'      => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vizove-i-doprose-ponyatih', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoOVedeniiAudiozapisiZasedania()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_number2'      => '123d4',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-o-vedenii-audiozapisi-zasedania', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionHodataistvoObOtsrochkeRassrochkeUplatyAdministrativnogoShtrafa()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_number2'      => '1234',
            'delo_privlechenpo' => 'дела случаются',
            'delo_shtraf'       => '1234',
            'delo_pricina'      => 'дела случаются',
            'delo_srok'         => '2 дня',
            'delo_do'           => '12.12.1234',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('hodataistvo-ob-otsrochke-rassrochke-uplaty-administrativnogo-shtrafa', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionObjasneniePoAdministrativnomyDely()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'             => 'Иванов Иван Иванович',
            'zayavitel_address'         => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'            => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_passport_seria'  => '2020',
            'zayavitel_passport_number' => '234567',
            'zayavitel_passport_vydan'  => '2012',
            'zayavitel_passport_code'   => '230-230',
            'zayavitel_phone'           => '+79215836465',
            'zayavitel_email'           => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_sud'          => 'Районный суд',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_number2'      => '1234',
            'delo_osnovanie'    => 'дела случаются',
            'delo_soglasie'     => 'не согласен',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('objasnenie-po-administrativnomy-dely', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZhalobaNaPostanovleniePoAdministrativnomyDely()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia1' => "Первая инстанция",
            'sud_instancia2' => "Вторая инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_number2'      => '1234',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_vid'          => 'дела случаются',
            'delo_pricina'      => 'дела случаются',
            'delo_pricina2'     => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zhaloba-na-postanovlenie-po-administrativnomy-dely', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZhalobaNaPostanovleniePoDelyObAdministrativnomPravonarushenii()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia1' => "Первая инстанция",
            'sud_instancia2' => "Вторая инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_number2'      => '1234',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_vid'          => 'дела случаются',
            'delo_pricina'      => 'дела случаются',
            'delo_pricina2'     => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zhaloba-na-postanovlenie-po-dely-ob-administrativnom-pravonarushenii', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionKassacionnayaZhalobaAdministrativnoePravo()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'       => "Преображенский коммунальный суд",
            'sud_instancia1' => "Первая инстанция",
            'sud_instancia2' => "Вторая инстанция",
            'sud_instancia3' => "Третья инстанция",
            'sud_address'    => 'г.Вытегра, Ленинский пр-т., д.19',

            'zayavitel_fio'     => 'Иванов Иван Иванович',
            'zayavitel_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'zayavitel_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'zayavitel_phone'   => '+79215836465',
            'zayavitel_email'   => 'surname@mail.ru',

            'predstavitel_fio' => 'Иванов Иван Сергеевич',
            'zaschitnick_fio'  => 'Иванов Иван Сергеевич',

            'delo_number' => '1234',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_zhalobana'    => 'Иванов Иван Петрович',
            'delo_day'          => '10',
            'delo_month'        => 'декабря',
            'delo_year'         => '1988',
            'delo_sud'          => 'Районный суд',
            'delo_sud2'         => 'Районный суд',
            'delo_number2'      => '1234',
            'delo_kto'          => 'Иванов Иван Петрович',
            'delo_privlechenpo' => 'дела случаются',
            'delo_vid'          => 'дела случаются',
            'delo_reshenie'     => 'дела случаются',
            'delo_pricina'      => 'дела случаются',
            'delo_day2'         => '10',
            'delo_month2'       => 'декабря',
            'delo_year2'        => '1988',
            'delo_pricina2'     => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('kassacionnaya-zhaloba-administrativnoe-pravo', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionAdministrativnoeIskovoeZayavlenie()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'    => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => '435646545565',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_nezakonno' => 'Документ №1',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('administrativnoe-iskovoe-zayavlenie', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }

    /**
     * @return string
     */
    public function actionZhalobaNaBezdeistvieSudebnogoPristava()
    {
        /** Общие данные */
        $random_filename = 'upload_pdf/' . Yii::$app->user->id . '-' . rand(10000000, 99999999) . '.pdf';

        $data = [
            'docName'          => 'Тестовый документ 1',
            'datetime_current' => date('d.m.Y'),

            'sud_name'    => "Преображенский коммунальный суд",
            'sud_address' => 'г.Вытегра, Ленинский пр-т., д.19',

            'istec_fio'     => 'Иванов Иван Иванович',
            'istec_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'istec_fact'    => 'г. Восток, Новая ул., д.35, кв.3',
            'istec_phone'   => '+79215836465',
            'istec_email'   => 'surname@mail.ru',

            'isk_predstavitel' => 'Иванов Иван Сергеевич',

            'otvetchick_fio'     => 'Иванов Иван Петрович',
            'otvetchick_address' => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_fact'    => 'г. Восток, Новая ул., д.30, кв.3',
            'otvetchick_inn'     => '435646545565',
            'otvetchick_phone'   => '+79215836465',
            'otvetchick_email'   => 'surname@mail.ru',

            'isk_poshlina' => '5000',

            'date_day'   => '10',
            'date_month' => 'декабря',
            'date_year'  => '1988',

            'delo_day'        => '10',
            'delo_month'      => 'декабря',
            'delo_year'       => '1988',
            'delo_osnovanie'  => 'дела случаются',
            'delo_o'          => 'дела случаются',
            'delo_osnovanie2' => 'дела случаются',
            'delo_pristav'    => 'Иванов Иван Сергеевич',
            'delo_po'         => 'дела случаются',

            'isk_podpis' => 'Hnht',
            'isk_shifr'  => 'Иванов И.И.',
        ];
        /** Шаблон */
        $html = $this->renderPartial('zhaloba-na-bezdeistvie-sudebnogo-pristava', [
            'data' => $data,
        ]);

        /** Генерация */
        include_once 'dompdf/autoload.inc.php';
        $dompdf = new Dompdf;
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Вывод файла в браузер:
        $dompdf->stream('test');

        // Сохранение на сервере:
        //$pdf = $dompdf->output();
        //file_put_contents($random_filename, $pdf);

        return $random_filename;
    }
    //
}