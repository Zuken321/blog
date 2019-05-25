<?php
namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

class PostsTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    public function getUsers()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id']);
    }

    /**
     * Собирает данные поста(пост, комментарии и форма добавления комментария)
     *
     * @return string| bool
     */
    public static function getPost($post_id)
    {
        $count_post = self::find()->where(['post_id' => $post_id])->count();
        if ($count_post != 0) {
            $post = self::findOne($post_id);

            $comments = CommentsTable::find()->where(['post_id' => $post_id]);
            $comments_provider =  new ActiveDataProvider([
                'query' => $comments,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                  'defaultOrder' => [
                      'comment_id' => SORT_DESC,
                  ],
                ],
            ]);

            $comment_form = new CommentForm();
            return compact('post', 'comments_provider', 'comment_form');
        }
        return false;
    }
}
