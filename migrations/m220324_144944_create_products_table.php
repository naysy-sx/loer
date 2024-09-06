<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m220324_144944_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id'          => $this->primaryKey(),
            'category_id' => $this->integer(),
            'title'       => $this->string()->notNull(),
            'image'       => $this->string(),
            'description' => $this->text(),
            'price'       => $this->integer(),
            'count'       => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
