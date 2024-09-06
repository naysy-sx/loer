<?php

namespace app\models\db;

use Yii;

/**
 * This is the model class for table "client_folders".
 *
 * @property int $id
 * @property int $creator_id
 * @property string $title
 * @property int|null $parent_folder_id
 * @property string $create_date
 * @property int $publish_status
 *
 * @property ClientDocuments[] $clientDocuments
 * @property ClientFolders $parentFolder
 * @property ClientFolders[] $clientFolders
 */
class ClientFolders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'client_folders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creator_id', 'title', 'create_date'], 'required'],
            [['creator_id', 'parent_folder_id', 'publish_status'], 'integer'],
            [['create_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['parent_folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClientFolders::className(), 'targetAttribute' => ['parent_folder_id' => 'id']],
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
            'title' => 'Title',
            'parent_folder_id' => 'Parent Folder ID',
            'create_date' => 'Create Date',
            'publish_status' => 'Publish Status',
        ];
    }

    /**
     * Gets query for [[ClientDocuments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientDocuments()
    {
        return $this->hasMany(ClientDocuments::className(), ['folder_id' => 'id']);
    }

    /**
     * Gets query for [[ParentFolder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentFolder()
    {
        return $this->hasOne(ClientFolders::className(), ['id' => 'parent_folder_id']);
    }

    /**
     * Gets query for [[ClientFolders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClientFolders()
    {
        return $this->hasMany(ClientFolders::className(), ['parent_folder_id' => 'id']);
    }
}
