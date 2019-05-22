<?php

use yii\db\Migration;

class m190522_073447_create_comments_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('comments', [
            'comment_id' => $this->primaryKey(),
            'post_id' => $this->integer(11)->notNull(),
            'author' => $this->string(30)->notNull(),
            'text' => $this->string(500)->notNull(),
        ]);

        $this->createIndex(
            'idx-comments-post_id',
            'comments',
            'post_id'
        );

        $this->addForeignKey(
        'fk-comments-post_id',
        'comments',
      'post_id',
      'posts',
    'post_id',
        'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-comments-post_id',
            'comments'
        );
        $this->dropIndex(
            'idx-comments-post_id',
            'comments'
        );
        $this->dropTable('comments');
    }
}
