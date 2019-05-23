<?php
namespace app\models;

use yii\db\ActiveRecord;

class CommentsTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id']);
    }
}