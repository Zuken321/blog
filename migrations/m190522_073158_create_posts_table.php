<?php

use yii\db\Migration;

class m190522_073158_create_posts_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('posts', [
            'post_id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'short_text' => $this->string(500)->notNull(),
            'text' => $this->string(5000)->notNull(),
        ]);
    }


    public function safeDown()
    {
        $this->dropTable('posts');
    }
}
