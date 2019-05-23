<?php

use yii\db\Migration;

/**
 * Handles adding author_id to table `{{%comments}}`.
 */
class m190523_051856_add_author_id_column_to_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('comments', 'author_id', $this->integer()->notNull());

        $this->addForeignKey(
          'fk-comments-author_id',
          'comments',
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
        $this->dropForeignKey(
            'fk-comments-author_id',
            'comments'
        );
    }
}
