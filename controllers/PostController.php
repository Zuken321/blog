<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PostForm;
use app\models\PostsTable;

class PostController extends Controller
{
    public function actionIndex()
    {
        $posts = PostsTable::find()->orderBy('post_id DESC')->all();
        return $this->render('index', compact('posts'));
    }

    public function actionPost()
    {
        if(isset($_GET['post_id'])) {
            $post_id = $_GET['post_id'];
            $post = PostsTable::findOne($post_id);
            if($post != null) {
                return $this->render('post', compact('post'));
            } else {
                return Yii::$app->response->redirect('/post');
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
        if($post_form->load(Yii::$app->request->post()) && $post_form->validate()) {
            $add_post = new PostsTable();
            $add_post->author_id = Yii::$app->user->identity->id;
            $add_post->title = $post_form->title;
            $add_post->short_text = $post_form->short_text;
            $add_post->text = $post_form->text;
            $add_post->save();
            return Yii::$app->response->redirect('/posts');
        }
        return $this->render('newPost', compact('post_form'));
    }
}
