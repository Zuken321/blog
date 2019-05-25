<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

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
     * Метод обрабатывает данные формы. При их валидности сохраняет пост в БД, иначе возвращает false
     */
    public function createPost()
    {
        if($this->validate()) {
            $create_post = new PostsTable();
            $create_post->author_id = Yii::$app->user->identity->id;
            $create_post->title = $this->title;
            $create_post->short_text = $this->short_text;
            $create_post->text = $this->text;
            return $create_post->save();
        }
        return false;
    }
}