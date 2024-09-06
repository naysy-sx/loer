<?php

namespace app\models\db;

/**
 * This is the model class for table "clients".
 *
 * @property int         $id
 * @property int         $company_id
 * @property int         $user_id
 * @property string|null $family
 * @property string|null $first_name
 * @property string|null $middle_name
 * @property string|null $pasport_serial
 * @property string|null $pasport_number
 * @property string|null $category_id
 * @property string|null $proc_status
 * @property string|null $inn
 * @property string|null $ogrn
 * @property string|null $kpp
 * @property string|null $jur_index
 * @property string|null $jur_address
 * @property string|null $fact_index
 * @property string|null $fact_address
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $created_at
 * @property string|null $status
 * @property string|null $comment
 * @property int         $status_position
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'company_id',
                    'user_id',
                ],
                'required',
            ],
            [
                [
                    'company_id',
                    'user_id',
                    'created_at',
                    'status_position',
                ],
                'integer',
            ],
            [
                [
                    'family',
                    'first_name',
                    'middle_name',
                    'pasport_serial',
                    'pasport_number',
                    'category_id',
                    'proc_status',
                    'inn',
                    'ogrn',
                    'kpp',
                    'jur_index',
                    'jur_address',
                    'fact_index',
                    'fact_address',
                    'email',
                    'phone',
                    'status',
                ],
                'string',
                'max' => 255,
            ],
            [
                ['comment', 'persons'],
                'safe',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'             => 'ID',
            'company_id'     => 'Компания',
            'user_id'        => 'User ID',
            'family'         => 'Family',
            'first_name'     => 'First Name',
            'middle_name'    => 'Middle Name',
            'pasport_serial' => 'Pasport Serial',
            'pasport_number' => 'Pasport Number',
        ];
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
