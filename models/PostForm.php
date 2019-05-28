<?php
namespace app\models;

use Yii;
use yii\base\Model;

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
     * Сохраняет|обновляет пост в БД
     *
     * @return bool
     */
    public function save($postId = null)
    {
        if(!$this->validate()) {
            return false;
        }
        if(!$postId) {
            $post = new PostsTable();
            $post->author_id = Yii::$app->user->id;
        } else {
            $post = PostsTable::findOne($postId);
        }
        $post->title = $this->title;
        $post->short_text = mb_strimwidth($this->text, 0, 500, "... Читать дальше...");
        $post->text = $this->text;
        return $post->save();
    }
}
