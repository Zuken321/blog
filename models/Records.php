<?php
namespace app\models;

use yii\db\ActiveRecord;

class Records extends ActiveRecord
{
    public static function tableName()
    {
        return 'records';
    }
}
?>