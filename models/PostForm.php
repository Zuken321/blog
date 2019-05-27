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
          [['title', 'text'], 'required'],
          [['title', 'text'], 'trim'],
          [['title', 'text'], 'default'],
          ['title', 'string', 'max' => 255],
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
            $create_post->short_text = mb_strimwidth($this->text, 0, 500, "... Читать дальше...");
            $create_post->text = $this->text;
            return $create_post->save();
        }
        return false;
    }

    public function updatePost($post_id)
    {
        if($this->validate()) {
            $update_post = PostsTable::findOne($post_id);
            $update_post->title = $this->title;
            $update_post->short_text = mb_strimwidth($this->text, 0, 500, "... Читать дальше...");
            $update_post->text = $this->text;
            return $update_post->save();
        }
        return false;
    }
}