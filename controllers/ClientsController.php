<?php

namespace app\controllers;

use app\models\db\Clients;
use app\models\db\CourtsAddresses;
use yii\web\Response;
use app\models\Notifications;
use Yii;
use yii\web\Controller;

/**
 * Клиенты
 * @package app\controllers
 */
class ClientsController extends Controller
{
	public $layout = 'clients';

	/**
	 * Просмотр всех
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect('index.php?r=site/login');
		}

		return $this->render('index');
	}

	public function actionNewDocument()
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect('index.php?r=site/login');
		}

    $userId = Yii::$app->request->get('user_id');
		$id = Yii::$app->request->get('id');
    return $this->render('editor', [
				'id' => $id,
        'user_id' => $userId,
    ]);
	}
	

	public function actionDocument()
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect('index.php?r=site/login');
		}

    $client_id = Yii::$app->request->get('user_id');
    $id = Yii::$app->request->get('id');
    return $this->render('document', [
        'id' => $id,
        'client_id' => $client_id,
    ]);
	}

	/**
	 * Добавление
	 *
	 * @return string
	 */
	public function actionAdd()
	{
		$this->layout = false;

		$model              = new Clients;
		$model->company_id  = 1;
		$model->user_id     = Yii::$app->user->id;
		$model->family      = htmlspecialchars($_GET['family']);
		$model->first_name  = htmlspecialchars($_GET['first_name']);
		$model->middle_name = htmlspecialchars($_GET['middle_name']);
		//        $model->category_id = htmlspecialchars($_GET['category_id']);
		//        $model->proc_status = htmlspecialchars($_GET['proc_status']);
		$model->inn         = htmlspecialchars($_GET['inn']);
		$model->ogrn        = htmlspecialchars($_GET['ogrn']);
		$model->kpp         = htmlspecialchars($_GET['kpp']);
		$model->jur_index   = htmlspecialchars($_GET['jur_index']);
		$model->jur_address = htmlspecialchars($_GET['jur_address']);
		//        $model->fact_index = htmlspecialchars($_GET['fact_index']);
		//        $model->fact_address = htmlspecialchars($_GET['fact_address']);
		//        $model->email = htmlspecialchars($_GET['email']);
		//        $model->phone = htmlspecialchars($_GET['phone']);
		$model->save();

		// создаем уведомление
		$user_id        = Yii::$app->user->id;
		$t              = time();
		$t              = date('Y-m-d', $t);
		$data           = new Notifications;
		$data->title    = "Новый клиент";
		$data->datetime = $t;
		$data->user_id  = $user_id;
		$data->save();

		return true;
	}

	/**
	 * Получение данных для правой модалки
	 *
	 * @return string
	 */
	public function actionGetClientInfo(): string
	{
		$this->layout = false;
		$client_id    = htmlspecialchars($_GET['clientid']);
		$data         = Clients::find()->where(['id' => $client_id])->one();

		return $this->render('_clientData', [
			'data' => $data,
		]);
	}
	public function actionGetCourtsByRegion()
	{
			Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	
			$district = htmlspecialchars(Yii::$app->request->get('district'));
	
			if (!$district) {
					return ['error' => 'Район не указан'];
			}
	
			$addresses = CourtsAddresses::find()
					->select(['id', 'name'])
					->where(['district' => $district])
					->asArray()
					->all();
	
			return $addresses;
	}
	// /**
	//  * Получение данных по всем клиентам
	//  *
	//  * @return string
	//  */
	// public function actionGetClients()
	// {
	//     $this->layout = false;
	//     $client_id    = htmlspecialchars($_GET['clientid']);
	//     $data         = Clients::find()->where(['user_id' => $client_id])->one(); // todo: првоерять по id компании

	//     return $this->render('_clientData', [
	//         'data' => $data,
	//     ]);
	// }

	/**
	 * Сохранение модалки клиентов
	 *
	 * @return bool
	 */
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


	/* ТЕСТОВЫЙ КОНТРОЛЛЕР */

	/*
      public function actionSaveModalFormTest(){

        echo '1'; exit;
        Yii::$app->response->format = Response::FORMAT_JSON;

        $yes = Yii::$app->response->format;

        echo 'yes [' . $yes . ']';

        // Получаем данные из POST запроса
        $postData = Yii::$app->request->post();

        // Проверяем, есть ли ID клиента
        if (isset($postData['id']) && !empty($postData['id'])) {
            $clientId = $postData['id'];

            // Находим клиента по ID
            $client = Client::findOne($clientId);

            if ($client) {
                // Обновляем поля клиента данными из формы
                $client->attributes = $postData;

                // Сохраняем изменения
                if ($client->save()) {
                    return ['success' => true, 'message' => 'Данные успешно сохранены'];
                } else {
                    return ['success' => false, 'message' => 'Ошибка при сохранении данных'];
                }
            } else {
                return ['success' => false, 'message' => 'Клиент с таким ID не найден'];
            }
        } else {
            return ['success' => false, 'message' => 'ID клиента не указан'];
        }
    }*/


	public function actionSaveModalFormTest()
	{
		echo 1;
		$this->layout = false;
		echo '<pre>';
		var_dump($_GET);
		echo '</pre>';

		$data = $_GET['data'] ?? [];
		echo 2;
		echo '<pre>';
		var_dump($data);
		echo '</pre>';

		$allowedFields = [
			'id',
			'court_region',
			'court_name',
			'company_id',
			'user_id',
			'subject',
			'gender',
			'birth_date',
			'birth_place',
			'family',
			'first_name',
			'middle_name',
			'pasport_serial',
			'pasport_number',
			'passport_issue_date',
			'passport_issuing_authority',
			'passport_issuing_authority_code',
			'category_id',
			'proc_status',
			'company_title',
			'inn',
			'snils',
			'ogrn',
			'ogrnip',
			'kpp',
			'jur_index',
			'jur_address',
			'fact_index',
			'fact_address',
			'email',
			'phone',
			'created_at',
			'status',
			'comment',
			'status_position',
			'persons',
		];

		$filteredData = array_intersect_key($data, array_flip($allowedFields));

		// Получаем клиента по id
		$id = htmlspecialchars($filteredData['id']);
		$cr_client = Clients::find()->where(['id' => $id])->one();

		if ($cr_client) {
			// Присваиваем значения полям модели
			foreach ($filteredData as $key => $value) {
				if ($key !== 'id' && !empty($value)) {
					$cr_client->$key = htmlspecialchars($value);
				}
			}

			// Сохраняем модель
			if ($cr_client->save()) {
				echo 'Данные успешно сохранены.';
			} else {
				echo 'Ошибка при сохранении данных.';
				foreach ($cr_client->getErrors() as $attribute => $errors) {
					foreach ($errors as $error) {
						echo "Ошибка в поле $attribute: $error\n";
					}
				}
			}
		} else {
			echo 'Клиент не найден.';
		}
		exit;
	}


	/**
	 * [ajax] Сохранение формы добавления клиента
	 *
	 * @return bool
	 */
	public function actionAjaxSaveForm()
	{
		$proc_status = htmlspecialchars($_GET['proc_status']);
		$client_f    = htmlspecialchars($_GET['client_f']);
		$client_i    = htmlspecialchars($_GET['client_i']);
		$client_o    = htmlspecialchars($_GET['client_o']);
		$bday        = htmlspecialchars($_GET['bday']);
		$sex         = htmlspecialchars($_GET['sex']);
		//        $r_city              = htmlspecialchars($_GET['r_city']);
		$reg_addr_index     = htmlspecialchars($_GET['reg_addr_index']);
		$reg_addr           = htmlspecialchars($_GET['reg_addr']);
		$fact_addr_index    = htmlspecialchars($_GET['fact_addr_index']);
		$fact_addr          = htmlspecialchars($_GET['fact_addr']);
		$snils              = htmlspecialchars($_GET['snils']);
		$inn                = htmlspecialchars($_GET['inn']);
		$doc_type           = htmlspecialchars($_GET['doc_type']);
		$doc_serial         = htmlspecialchars($_GET['doc_serial']);
		$doc_num            = htmlspecialchars($_GET['doc_num']);
		$orgname            = htmlspecialchars($_GET['orgname']);
		$orginn             = htmlspecialchars($_GET['orginn']);
		$orgkpp             = htmlspecialchars($_GET['orgkpp']);
		$orgogrn            = htmlspecialchars($_GET['orgogrn']);
		$org_jur_addr_index = htmlspecialchars($_GET['org_jur_addr_index']);
		$org_jur_addr       = htmlspecialchars($_GET['org_jur_addr']);
		//        $org_fact_addr_index = htmlspecialchars($_GET['org_fact_addr_index']);
		//        $org_fact_addr       = htmlspecialchars($_GET['org_fact_addr']);
		$ogrnip      = htmlspecialchars($_GET['ogrnip']);
		$email       = htmlspecialchars($_GET['email']);
		$phone       = htmlspecialchars($_GET['phone']);
		$category_id = htmlspecialchars($_GET['category_id']);

		$comment = htmlspecialchars($_GET['comment']);

		/** @var Clients $new_client */
		$new_client             = new Clients;
		$new_client->company_id = 0;
		$new_client->user_id    = Yii::$app->user->id;

		$new_client->pasport_serial = $doc_serial;
		$new_client->pasport_number = $doc_num;
		$new_client->category_id    = '';
		$new_client->proc_status    = $proc_status;

		if (isset($orgname) && mb_strlen($orgname) > 0) { // организация
			$new_client->family      = $orgname;
			$new_client->first_name  = '';
			$new_client->middle_name = '';

			$new_client->inn          = $orginn;
			$new_client->ogrn         = $orgogrn;
			$new_client->kpp          = $orgkpp;
			$new_client->jur_index    = $org_jur_addr_index;
			$new_client->jur_address  = $org_jur_addr;
			$new_client->fact_index   = $org_fact_addr_index;
			$new_client->fact_address = $org_fact_addr;
		} else { // частное лицо
			$new_client->family      = $client_f;
			$new_client->first_name  = $client_i;
			$new_client->middle_name = $client_o;

			$new_client->inn          = $inn;
			$new_client->ogrn         = $ogrnip;
			$new_client->kpp          = '';
			$new_client->jur_index    = $reg_addr_index;
			$new_client->jur_address  = $reg_addr;
			$new_client->fact_index   = $fact_addr_index;
			$new_client->fact_address = $fact_addr;
		}

		$new_client->email       = $email;
		$new_client->phone       = $phone;
		$new_client->created_at  = time();
		$new_client->status      = '';
		$new_client->category_id = $category_id;
		$new_client->comment     = $comment;

		// определение и установка статуса
		if (!empty($_GET['page-refer'])) {
			$refer = htmlspecialchars($_GET['page-refer']);
			$refer = explode('?r=', $refer);
			$refer = end($refer);

			if ($refer == 'clients') {
				$new_client->status_position = 6;
			} else {
				$new_client->status_position = 1;
			}
		} else {
			$new_client->status_position = 1;
		}

		$new_client->save();

		//        echo '<pre>';
		//        var_dump($new_client);
		//        exit;

		return true;
	}

	/**
	 * Добавление персоны в дело
	 *
	 * @return bool
	 */
	public function actionAjaxSaveFormPersons()
	{
		$person_data['id']                 = htmlspecialchars($_GET['id']);
		$person_data['proc_status']        = htmlspecialchars($_GET['proc_status']);
		$person_data['client_f']           = htmlspecialchars($_GET['client_f']);
		$person_data['client_i']           = htmlspecialchars($_GET['client_i']);
		$person_data['client_o']           = htmlspecialchars($_GET['client_o']);
		$person_data['bday']               = htmlspecialchars($_GET['bday']);
		$person_data['sex']                = htmlspecialchars($_GET['sex']);
		$person_data['reg_addr_index']     = htmlspecialchars($_GET['reg_addr_index']);
		$person_data['reg_addr']           = htmlspecialchars($_GET['reg_addr']);
		$person_data['fact_addr_index']    = htmlspecialchars($_GET['fact_addr_index']);
		$person_data['fact_addr']          = htmlspecialchars($_GET['fact_addr']);
		$person_data['snils']              = htmlspecialchars($_GET['snils']);
		$person_data['inn']                = htmlspecialchars($_GET['inn']);
		$person_data['doc_type']           = htmlspecialchars($_GET['doc_type']);
		$person_data['doc_serial']         = htmlspecialchars($_GET['doc_serial']);
		$person_data['doc_num']            = htmlspecialchars($_GET['doc_num']);
		$person_data['orgname']            = htmlspecialchars($_GET['orgname']);
		$person_data['orginn']             = htmlspecialchars($_GET['orginn']);
		$person_data['orgkpp']             = htmlspecialchars($_GET['orgkpp']);
		$person_data['orgogrn']            = htmlspecialchars($_GET['orgogrn']);
		$person_data['org_jur_addr_index'] = htmlspecialchars($_GET['org_jur_addr_index']);
		$person_data['org_jur_addr']       = htmlspecialchars($_GET['org_jur_addr']);
		$person_data['ogrnip']             = htmlspecialchars($_GET['ogrnip']);
		$person_data['email']              = htmlspecialchars($_GET['email']);
		$person_data['phone']              = htmlspecialchars($_GET['phone']);

		$client = Clients::find()->where(['id' => $person_data['id']])->one();

		if ($client) {
			if (mb_strlen($client->persons) > 1) {
				$persons = json_decode($client->persons);
			} else {
				$persons = [];
			}

			$persons[]       = $person_data;
			$client->persons = json_encode($persons);
			$client->save();
		}

		return true;
	}
}
