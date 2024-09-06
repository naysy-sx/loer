<?php

namespace app\models\db;

/**
 * This is the model class for table "courts_addresses".
 *
 * @property int         $id
 * @property string|null $region
 * @property string|null $district
 * @property string|null $city
 * @property string|null $name
 * @property string|null $name_kem
 * @property string|null $name_kogo
 * @property string|null $address
 * @property string|null $phone
 */
class CourtsAddresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courts_addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'region',
                    'district',
                    'name',
                    'name_kem',
                    'name_kogo',
                    'address',
                    'phone',
                    'city',
                ],
                'string',
                'max' => 255,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'region'   => 'Region',
            'district' => 'District',
            'city'     => 'city',
            'name'     => 'Name',
            'address'  => 'Address',
            'phone'    => 'Phone',
        ];
    }
}
