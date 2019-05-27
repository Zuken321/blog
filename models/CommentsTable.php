<?php
namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class CommentsTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * Устанавливает связь между таблицами Comments и Users
     *
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id']);
    }

    /**
     * Устанавливает связь между таблицами Comments и Posts
     *
     * @return ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(User::className(), ['post_id' => 'post_id']);
    }

}