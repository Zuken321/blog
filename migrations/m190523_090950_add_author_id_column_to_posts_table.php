<?php

use yii\db\Migration;

/**
 * Handles adding author_id to table `{{%posts}}`.
 */
class m190523_090950_add_author_id_column_to_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('posts','author_id', $this->integer()->notNull());
        $this->addForeignKey(
            'fk-posts-author_id',
            'posts',
          'author_id',
          'users',
        'user_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-posts-author_id', 'posts');
        $this->dropColumn('posts','author_id');
    }
}
