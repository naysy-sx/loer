<?php

namespace app\models\db;

/**
 * This is the model class for table "court_cases".
 *
 * @property int         $id
 * @property int|null    $company_id
 * @property int|null    $user_id
 * @property int|null    $client_id
 * @property int|null    $court_id
 * @property string|null $case_number
 * @property int|null    $department_id
 * @property int|null    $date_create
 * @property int|null    $date_update
 * @property int|null    $date_delete
 * @property int|null    $date_processing
 * @property string|null $comment
 * @property string|null $responsible
 */
class CourtCases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'court_cases';
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
                    'client_id',
                    'court_id',
                    'department_id',
                    'date_create',
                    'date_update',
                    'date_delete',
                    'date_processing',
                ],
                'integer',
            ],
            [
                ['comment'],
                'string',
            ],
            [
                [
                    'case_number',
                    'responsible',
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
            'id'              => 'ID',
            'company_id'      => 'Company ID',
            'user_id'         => 'User ID',
            'client_id'       => 'Client ID',
            'court_id'        => 'Court ID',
            'case_number'     => 'Case Number',
            'department_id'   => 'Department ID',
            'date_create'     => 'Date Create',
            'date_update'     => 'Date Update',
            'date_delete'     => 'Date Delete',
            'date_processing' => 'Date Processing',
            'comment'         => 'Comment',
            'responsible'     => 'Responsible',
        ];
    }
}
