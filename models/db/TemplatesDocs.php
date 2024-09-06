<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "templates_docs".
 *
 * @property int $id
 * @property string|null $type
 * @property string|null $translit_type
 * @property string|null $title
 * @property string|null $pravo
 * @property string|null $translit_pravo
 * @property string|null $content
 * @property int $client_id
 * @property int $custom
 */
class TemplatesDocs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'templates_docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'client_id', 'custom'], 'integer'],
            [['type'], 'string', 'max' => 20],
            [['translit_type'], 'string', 'max' => 24],
            [['title'], 'string', 'max' => 107],
            [['pravo'], 'string', 'max' => 998],
            [['translit_pravo'], 'string', 'max' => 2679],
            [['content'], 'string', 'max' => 3087],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'translit_type' => 'Translit Type',
            'title' => 'Title',
            'pravo' => 'Pravo',
            'translit_pravo' => 'Translit Pravo',
            'content' => 'Content',
            'client_id' => 'Client ID',
            'custom' => 'Custom',
        ];
    }
}
