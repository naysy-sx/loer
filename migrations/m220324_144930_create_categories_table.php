<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m220324_144930_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id'          => $this->primaryKey(),
            'parent_id'   => $this->integer(),
            'title'       => $this->string()->notNull(),
            'icon'        => $this->string(),
            'image'       => $this->string(),
            'description' => $this->text(),
            'datetime'    => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}
