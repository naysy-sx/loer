<?php

namespace app\models\db;

/**
 * This is the model class for table "folders".
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $parent_id
 * @property string $name
 * @property int    $active
 * @property int    $client_id
 * @property int    $order_id
 */
class Folders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folders';
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
                    'parent_id',
                    'name',
                    'active',
                ],
                'required',
            ],
            [
                [
                    'user_id',
                    'parent_id',
                    'active',
                    'client_id',
                    'order_id',
                ],
                'integer',
            ],
            [
                ['name'],
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
            'id'        => 'ID',
            'user_id'   => 'User ID',
            'parent_id' => 'Parent ID',
            'name'      => 'Name',
            'active'    => 'Active',
        ];
    }
}
