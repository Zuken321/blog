<?php

use yii\db\Migration;

/**
 * Handles dropping author from table `{{%comments}}`.
 */
class m190523_051744_drop_author_column_from_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('comments', 'author');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('comments', 'author', $this->string(30));
    }
}
