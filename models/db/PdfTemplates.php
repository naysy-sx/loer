<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "pdf_templates".
 *
 * @property int $id
 * @property string $doc_title
 * @property string $cyrilic_title
 * @property string $path
 */
class PdfTemplates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pdf_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc_title', 'cyrilic_title', 'path'], 'required'],
            [['doc_title', 'cyrilic_title', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc_title' => 'Doc Title',
            'cyrilic_title' => 'Cyrilic Title',
            'path' => 'Path',
        ];
    }
}
