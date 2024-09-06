<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property string|null $subject
 * @property string|null $gender
 * @property string|null $birth_date
 * @property string|null $birth_place
 * @property string|null $family
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $avatar
 * @property string|null $pasport_serial
 * @property string|null $pasport_number
 * @property string|null $passport_issue_date
 * @property string|null $passport_issuing_authority
 * @property string|null $passport_issuing_authority_code
 * @property string|null $category_id
 * @property string|null $proc_status
 * @property string|null $company_title
 * @property string|null $inn
 * @property string|null $snils
 * @property string|null $ogrn
 * @property string|null $ogrnip
 * @property string|null $kpp
 * @property string|null $jur_index
 * @property string|null $jur_address
 * @property string|null $fact_index
 * @property string|null $fact_address
 * @property string|null $email
 * @property string|null $phone
 * @property int|null $created_at
 * @property string|null $status
 * @property string|null $comment
 * @property int $status_position
 * @property string|null $persons
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'status_position'], 'required'],
            [['company_id', 'user_id', 'created_at', 'status_position'], 'integer'],
            [['gender', 'comment', 'persons'], 'string'],
            [['birth_date', 'passport_issue_date'], 'safe'],
            [['subject', 'birth_place', 'family', 'first_name', 'middle_name', 'pasport_serial', 'pasport_number', 'passport_issuing_authority', 'category_id', 'proc_status', 'company_title', 'inn', 'ogrn', 'kpp', 'jur_index', 'jur_address', 'fact_index', 'fact_address', 'email', 'phone', 'status'], 'string', 'max' => 255],
            [['avatar'], 'string', 'max' => 155],
            [['passport_issuing_authority_code'], 'string', 'max' => 10],
            [['snils'], 'string', 'max' => 14],
            [['ogrnip'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'subject' => 'Subject',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'birth_place' => 'Birth Place',
            'family' => 'Family',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'avatar' => 'Avatar',
            'pasport_serial' => 'Pasport Serial',
            'pasport_number' => 'Pasport Number',
            'passport_issue_date' => 'Passport Issue Date',
            'passport_issuing_authority' => 'Passport Issuing Authority',
            'passport_issuing_authority_code' => 'Passport Issuing Authority Code',
            'category_id' => 'Category ID',
            'proc_status' => 'Proc Status',
            'company_title' => 'Company Title',
            'inn' => 'Inn',
            'snils' => 'Snils',
            'ogrn' => 'Ogrn',
            'ogrnip' => 'Ogrnip',
            'kpp' => 'Kpp',
            'jur_index' => 'Jur Index',
            'jur_address' => 'Jur Address',
            'fact_index' => 'Fact Index',
            'fact_address' => 'Fact Address',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'status' => 'Status',
            'comment' => 'Comment',
            'status_position' => 'Status Position',
            'persons' => 'Persons',
        ];
    }

    /**
     * @param $id
     *
     * @return mixed|null
     */
    public static function getNameById($id)
    {
        $client = self::find()->where(['id' => $id])->one();

        return "{$client['family']} {$client['first_name']} {$client['middle_name']} ";
    }

    /**
     * Получение краткие ФИО по id клиента
     *
     * @param $client_id
     *
     * @return string
     */
    public static function getClientFioInic($client_id)
    {
        $data = self::find()->where(['id' => $client_id])->one();

        if (isset($data->first_name)) {
            $first_name_inic = mb_substr($data->first_name, 0, 1, 'UTF-8');
        }

        if (isset($data->middle_name)) {
            $middle_name_inic = mb_substr($data->middle_name, 0, 1, 'UTF-8');
        }

        $fio = "{$data->family} {$first_name_inic}. {$middle_name_inic}.";

        return $fio;
    }
    
}
