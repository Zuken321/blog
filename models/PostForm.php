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
          [['title', 'short_text', 'text'], 'trim'],
          [['title', 'short_text', 'text'], 'default'],
          ['title', 'string', 'max' => 255],
          ['short_text', 'string', 'max' => 500],
          ['text', 'string', 'max' => 5000],
        ];
    }
}