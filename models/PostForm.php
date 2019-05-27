<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;

class PostForm extends Model
{
    public $title, $short_text, $text;

    /**
     * @return array the validation rules.
     */
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

    /**
     * Сохраняет пост в БД
     *
     * @return bool
     */
    public function createPost()
    {
        if($this->validate()) {
            $createPost = new PostsTable();
            $createPost->author_id = Yii::$app->user->identity->id;
            $createPost->title = $this->title;
            $createPost->short_text = mb_strimwidth($this->text, 0, 500, "... Читать дальше...");
            $createPost->text = $this->text;
            return $createPost->save();
        }
        return false;
    }

    /**
     * Обновляет пост в БД
     *
     * @return bool
     */
    public function updatePost($postId)
    {
        if($this->validate()) {
            $updatePost = PostsTable::findOne($postId);
            $updatePost->title = $this->title;
            $updatePost->short_text = mb_strimwidth($this->text, 0, 500, "... Читать дальше...");
            $updatePost->text = $this->text;
            return $updatePost->save();
        }
        return false;
    }
}