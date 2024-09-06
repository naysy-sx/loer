<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "client_documents".
 *
 * @property int $id
 * @property int $creator_id
 * @property int|null $folder_id
 * @property string $title
 * @property string|null $type
 * @property string|null $pravo
 * @property string $create_date
 * @property int $publish_status
 * @property string|null $content
 * @property string|null $last_modified_date
 * @property int|null $last_modified_by
 * @property string|null $tags
 *
 * @property ClientFolders $folder
 */
class ClientDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'title', 'create_date'], 'required'],
            [['creator_id', 'folder_id', 'publish_status', 'last_modified_by'], 'integer'],
            [['create_date', 'last_modified_date'], 'safe'],
            [['content'], 'string'],
            [['title', 'type', 'pravo', 'tags'], 'string', 'max' => 255],
            [['folder_id'], 'default', 'value' => 0],
            [['folder_id'], 'integer'],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientFolders::className(), 'targetAttribute' => ['folder_id' => 'id'], 'when' => function($model) {
                return $model->folder_id > 0;
            }],
        ];
    }   
    

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creator_id' => 'Creator ID',
            'folder_id' => 'Folder ID',
            'title' => 'Title',
            'type' => 'Type',
            'pravo' => 'Pravo',
            'create_date' => 'Create Date',
            'publish_status' => 'Publish Status',
            'content' => 'Content',
            'last_modified_date' => 'Last Modified Date',
            'last_modified_by' => 'Last Modified By',
            'tags' => 'Tags',
        ];
    }

    /**
     * Gets query for [[Folder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(ClientFolders::className(), ['id' => 'folder_id']);
    }
}
