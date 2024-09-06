<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "tmp_doc".
 *
 * @property int $id
 * @property string $doc
 */
class TmpDoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tmp_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doc'], 'required'],
            [['doc'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doc' => 'Doc',
        ];
    }
}
