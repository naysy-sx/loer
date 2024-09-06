<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cart}}`.
 */
class m220324_144954_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cart}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer(),
            'products'   => $this->text(),
            'status'     => $this->integer(),
            'datetime'   => $this->integer(),
            'totalprice' => $this->integer(),
            'totalqty'   => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cart}}');
    }
}
