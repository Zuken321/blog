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
        ];
    }

    public function addComment($form, $post_id)
    {
        if ($this->validate()) {
            $add_comment = new CommentsTable();
            $add_comment->post_id = $post_id;
            $add_comment->author_id = Yii::$app->user->identity->id;
            $add_comment->text = $form->text;
            return $add_comment->save();
        }
        return false;
    }
}