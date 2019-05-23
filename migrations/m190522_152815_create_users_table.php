<?php

use yii\db\Migration;


class m190522_152815_create_users_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('users', [
            'user_id' => $this->primaryKey(),
            'username' => $this->string(30)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    public function safeDown()
    {
        $this->dropTable('users');
    }
}
