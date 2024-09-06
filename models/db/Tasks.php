<?php

namespace app\models\db;

/**
 * This is the model class for table "tasks".
 *
 * @property int         $id
 * @property int         $user_id
 * @property int         $creator_id
 * @property int|null    $client_id
 * @property int|null    $order_id
 * @property int|null    $datetime
 * @property int|null    $datetime_end
 * @property int         $title
 * @property string      $description
 * @property int         $status
 * @property int|null    $day
 * @property int|null    $month
 * @property int|null    $year
 * @property string|null $time
 * @property int         $status_position
 * @property int|null    $overdue
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
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
                    'description',
                    'status',
                ],
                'required',
            ],
            [
                [
                    'creator_id',
                    'user_id',
                    'client_id',
                    'order_id',
                    'status',
                    'day',
                    'month',
                    'year',
                    'status_position',
                    'overdue',
                ],
                'integer',
            ],
            [
                [
                    'title',
                    'description',
                ],
                'string',
            ],
            [
                [
                    'datetime',
                    'datetime_end',
                ],
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
            'id'          => 'ID',
            'user_id'     => 'User ID',
            'client_id'   => 'Client ID',
            'order_id'    => 'Order ID',
            'datetime'    => 'Datetime',
            'description' => 'Description',
            'status'      => 'Status',
            'overdue'     => 'Просрочена',
        ];
    }
}
