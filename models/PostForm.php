<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class PostForm
 *
 * Модель обрабатывает получаемые с формы данные
 *
 * @package app\models
 */
class PostForm extends Model
{
    public $title, $text, $author_id;
    public $postId = null;

    public function __construct($config = [])
    {
        parent::__construct($config);
        if($this->postId != null) {
            $this->find($this->postId);
        }
    }

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

    public function find($postId)
    {
        $post = PostsTable::findOne($postId);
        $this->author_id = $post->author_id;
        $this-> title = $post->title;
        $this->text = $post->text;
        return $this;
    }
}
