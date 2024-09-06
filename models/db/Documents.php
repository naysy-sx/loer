<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property int|null $client_id
 * @property string $type
 * @property string $translit_type
 * @property string $title
 * @property string $pravo
 * @property string $translit_pravo
 * @property string $content
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id'], 'integer'],
            [['type', 'translit_type', 'title', 'pravo', 'translit_pravo', 'content'], 'required'],
            [['pravo', 'translit_pravo', 'content'], 'string'],
            [['type', 'translit_type', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'type' => 'Type',
            'translit_type' => 'Translit Type',
            'title' => 'Title',
            'pravo' => 'Pravo',
            'translit_pravo' => 'Translit Pravo',
            'content' => 'Content',
        ];
    }
}
