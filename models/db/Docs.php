<?php
namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "docs".
 *
 * @property int $id
 * @property int $is_folder
 * @property string $folder
 * @property string $title
 * @property string $category
 * @property string $pravo
 * @property int $user_id
 * @property string $create_date
 * @property string $publish_status
 * @property string $content
 * @property string|null $last_modified_date
 * @property int|null $last_modified_by
 * @property int $version
 * @property string|null $tags
 * @property string|null $file_path
 * @property int $is_template
 * @property int|null $related_case_id
 * @property string|null $expiration_date
 * @property string $confidentiality_level
 */
class Docs extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'docs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_folder', 'user_id', 'last_modified_by', 'version', 'is_template', 'related_case_id'], 'integer'],
            [['title'], 'required'],
            [['folder', 'category', 'pravo', 'content'], 'required', 'when' => function($model) {
                return $model->is_folder == 0;
            }, 'whenClient' => "function (attribute, value) {
                return $('#doc-is_folder').val() == 0;
            }"],
            [['create_date', 'last_modified_date', 'expiration_date'], 'safe'],
            [['publish_status', 'content', 'confidentiality_level'], 'string'],
            [['folder', 'title', 'tags', 'file_path'], 'string', 'max' => 255],
            [['category', 'pravo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'is_folder' => 'Is Folder',
            'folder' => 'Folder',
            'title' => 'Title',
            'category' => 'Category',
            'pravo' => 'Pravo',
            'user_id' => 'User ID',
            'create_date' => 'Create Date',
            'publish_status' => 'Publish Status',
            'content' => 'Content',
            'last_modified_date' => 'Last Modified Date',
            'last_modified_by' => 'Last Modified By',
            'version' => 'Version',
            'tags' => 'Tags',
            'file_path' => 'File Path',
            'is_template' => 'Is Template',
            'related_case_id' => 'Related Case ID',
            'expiration_date' => 'Expiration Date',
            'confidentiality_level' => 'Confidentiality Level',
        ];
    }
}
