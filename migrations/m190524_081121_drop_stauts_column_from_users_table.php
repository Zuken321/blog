<?php

use yii\db\Migration;

/**
 * Handles dropping stauts from table `{{%users}}`.
 */
class m190524_081121_drop_stauts_column_from_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('users','status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('users','status', $this->smallInteger(6)->notNull());
    }
}
