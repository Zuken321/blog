<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PostForm;
use app\models\PostsTable;

class PostController extends Controller
{
    /*
     * Экшен выводит все посты из БД
     */
    public function actionIndex()
    {
        $post_table = new PostsTable();
        $posts = $post_table->getPosts();
        return $this->render('index', $posts);
    }

    /*
     * Экшен выводит из БД пост с указанным id
     */
    public function actionPost($post_id)
    {
        if (isset($post_id)) {
            $post_table = new PostsTable();
            $post = $post_table->getPost($post_id);

            if ($post != false) {
                return $this->render('post', $post);
            }
        }
        return Yii::$app->response->redirect('/posts');
    }

    /*
     * Экшен отображает форму добавления постов, при отправки формы обрабатывает данные, при успешной валидации добавляет пост в БД
     * Добавление постов доступно только авторизованным пользователям
     */
    public function actionNewPost()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect('/posts');
        }
        $post_form = new PostForm();
        if ($post_form->load(Yii::$app->request->post()) && $post_form->addPost($post_form)) {
            return Yii::$app->response->redirect('/posts');
        }
        return $this->render('newPost', compact('post_form')); // надо обработать ошибку при некорректных данных
    }
}
