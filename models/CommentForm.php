<?php
namespace app\models;

use yii\base\Model;

class CommentForm extends Model
{
    public $author, $text;

    public function rules()
    {
        return [
            [['author', 'email'], 'required'],

        ];
    }
}