<?php
namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $author, $text;

    public function rules()
    {
        return [
            ['text', 'required'],
            ['text', 'trim'],
            ['text', 'default'],
        ];
    }

    /*
     * Метод проверяет полученные данные с формы на валидность. Если данные валидны заносит комментарий в базу,
     * иначе возвразает false
     */
    public function createComment($post_id)
    {
        if ($this->validate()) {
            $create_comment = new CommentsTable();
            $create_comment->post_id = $post_id;
            $create_comment->author_id = Yii::$app->user->identity->id;
            $create_comment->text = $this->text;
            return $create_comment->save();
        }
        return false;
    }
}