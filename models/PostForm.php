<?php
namespace app\models;

use yii\base\Model;

class PostForm extends Model
{
    public $title, $short_text, $text;

    public function rules()
    {
        return [
          [['title', 'short_text', 'text'], 'required'],
        ];
    }
}