<?php
namespace app\models;

use yii\db\ActiveRecord;

class CommentsTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }
}