<?php

namespace app\models\db;

/**
 * This is the model class for table "companys".
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $name
 * @property string $requisites
 * @property string $description
 * @property string $avatar
 * @property string $inn
 * @property string $kpp
 * @property string $bank
 * @property string $ks
 */
class Companys extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'companys';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'user_id',
                    'name',
                ],
                'required',
            ],
            [
                ['user_id'],
                'integer',
            ],
            [
                [
                    'name',
                    'description',
                    'avatar',
                    'inn',
                    'kpp',
                    'bank',
                    'ks',
                ],
                'string',
                'max' => 255,
            ],
            [
                ['requisites'],
                'string',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'      => 'ID',
            'user_id' => 'User ID',
            'name'    => 'Name',
        ];
    }
}
