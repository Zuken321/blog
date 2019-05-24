<?php

namespace app\controllers;

use app\models\CommentsTable;
use Yii;
use yii\web\Controller;
use app\models\PostForm;
use app\models\PostsTable;
use yii\data\ArrayDataProvider;
use app\models\CommentForm;

class PostController extends Controller
{
    public function actionIndex()
    {
        $posts = PostsTable::find()->orderBy('post_id DESC')->all();
        $posts_provider =  new ArrayDataProvider([
            'allModels' => $posts,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', compact('posts_provider'));
    }

    public function actionPost($post_id)
    {
        if(isset($post_id)) {
            $count_post = PostsTable::find()->where(['post_id' => $post_id])->count();
            if($count_post != 0) {
                $post = PostsTable::findOne($post_id);

                $comments = CommentsTable::find()->orderBy('comment_id DESC')->all();
                $comments_provider =  new ArrayDataProvider([
                    'allModels' => $comments,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                ]);

                $model = new CommentForm();
                return $this->render('post', compact('post', 'comments_provider', 'model'));
            } else {
                return Yii::$app->response->redirect('/posts');
            }
        } else {
            return Yii::$app->response->redirect('/posts');
        }
    }

    public function actionNewPost()
    {
        if(Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect('/posts');
        }
        $post_form = new PostForm();
        if($post_form->load(Yii::$app->request->post()) && $post_form->addPost($post_form)) {
            return Yii::$app->response->redirect('/posts');
        }
        return $this->render('newPost', compact('post_form'));
    }
}
