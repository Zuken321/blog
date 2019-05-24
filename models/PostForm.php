<?php
namespace app\models;

use Yii;
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

    /*
     * При успешной валидации добавляет пост в БД
     */
    public function addPost($form)
    {
        if ($this->validate()) {
            $add_post = new PostsTable();
            $add_post->author_id = Yii::$app->user->identity->id;
            $add_post->title = $form->title;
            $add_post->short_text = $form->short_text;
            $add_post->text = $form->text;
            return $add_post->save();
        }
        return false;
    }
}