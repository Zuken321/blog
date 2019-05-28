<?php
namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Class CommentsTable
 * @package app\models
 * @property User[] $users
 * @property PostsTable[] $posts
 */
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
        return $this->hasOne(User::class, ['user_id' => 'author_id']);
    }

    /**
     * Устанавливает связь между таблицами Comments и Posts
     *
     * @return ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasOne(PostsTable::class, ['post_id' => 'post_id']);
    }

}
