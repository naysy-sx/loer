<?php

namespace app\models\db;

/**
 * This is the model class for table "uploaded_files".
 *
 * @property int      $id
 * @property int      $user_id
 * @property int|null $client_id
 * @property int|null $order_id
 * @property int      $folder_id
 * @property string   $filename
 * @property string   $path
 */
class UploadedFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uploaded_files';
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
                    'folder_id',
                    'filename',
                    'path',
                ],
                'required',
            ],
            [
                [
                    'user_id',
                    'client_id',
                    'order_id',
                    'folder_id',
                ],
                'integer',
            ],
            [
                ['path',],
                'file',
            ],
            [
                [
                    'filename',
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
            'id'        => 'ID',
            'user_id'   => 'User ID',
            'client_id' => 'Client ID',
            'order_id'  => 'Order ID',
            'folder_id' => 'Folder ID',
            'filename'  => 'Filename',
            'path'      => 'Path',
        ];
    }
}
