<?php
namespace app\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class PostsTable extends ActiveRecord
{
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * Устанавливает связь между таблицами Posts и Users
     *
     * @return ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['user_id' => 'author_id']);
    }

    /**
     * Устанавливает связь между таблицами Posts и Comments
     *
     * @return ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(CommentsTable::className(), ['post_id' => 'post_id']);
    }

    /**
     * Собирает данные поста(пост, комментарии и форма добавления комментария)
     *
     * @return array| bool
     */
    public static function getPost($postId)
    {
        $countPost = self::find()->where(['post_id' => $postId])->count();
        if ($countPost != 0) {
            $post = self::findOne($postId);

            $commentsProvider =  new ActiveDataProvider([
                'query' => $post->getComments(),
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                  'defaultOrder' => [
                      'comment_id' => SORT_DESC,
                  ],
                ],
            ]);

            $commentForm = new CommentForm();
            return compact('post', 'commentsProvider', 'commentForm');
        }
        return false;
    }
}
