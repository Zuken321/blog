<?php
namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $author, $text;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['text', 'required'],
            ['text', 'trim'],
            ['text', 'default'],
        ];
    }

    /**
     * Сохраняет комментарий в БД
     *
     * @param integer $postId
     * @return bool
     */
    public function createComment($postId)
    {
        if (!$this->validate()) {
            return false;
        }
        $createComment = new CommentsTable();
        $createComment->post_id = $postId;
        $createComment->author_id = Yii::$app->user->identity->id;
        $createComment->text = $this->text;
        return $createComment->save();
    }
}