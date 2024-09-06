<?php

namespace app\models\db;

/**
 * This is the model class for table "crm".
 *
 * @property int         $id
 * @property int|null    $client_id
 * @property string|null $client_str
 * @property int         $status
 * @property int         $datetime
 * @property string|null $worker
 * @property string|null $refer
 * @property string|null $comment
 * @property string|null $task
 * @property int|null    $deadline
 */
class Crm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'crm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'client_id',
                    'status',
                    'datetime',
                ],
                'integer',
            ],
            [
                [
                    'status',
                    'datetime',
                    'client_str',
                ],
                'required',
            ],
            [
                [
                    'comment',
                    'task',
                ],
                'string',
            ],
            [
                [
                    'client_str',
                    'worker',
                    'refer',
                ],
                'string',
                'max' => 255,
            ],
            [
                ['deadline'],
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
            'id'         => 'ID',
            'client_id'  => 'Выберите клиента',
            'client_str' => 'Наименование клиента',
            'status'     => 'Статус',
            'datetime'   => 'Дата',
            'worker'     => 'Ответственный',
            'refer'      => 'Источник',
            'comment'    => 'Комментарий',
            'task'       => 'Задача',
            'deadline'   => 'Завершить к',
        ];
    }
}
