<?php
namespace app\models;

use Yii;
use yii\data\ArrayDataProvider;
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

    public function getPost($post_id)
    {
        $count_post = $this->find()->where(['post_id' => $post_id])->count();
        if ($count_post != 0) {
            $post = $this->findOne($post_id);

            $comments = CommentsTable::find()->where(['post_id' => $post_id])->orderBy('comment_id DESC')->all();
            $comments_provider =  new ArrayDataProvider([
                'allModels' => $comments,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]);

            $model = new CommentForm();
            return compact('post', 'comments_provider', 'model');
        }
        return false;
    }

    public function getPosts()
    {
        $posts = $this->find()->orderBy('post_id DESC')->all();
        $posts_provider =  new ArrayDataProvider([
            'allModels' => $posts,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return compact('posts_provider');
    }
}
?>