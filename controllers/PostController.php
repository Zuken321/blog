<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\helpers\Html;
use app\models\PostForm;
use app\models\PostsTable;

/*
 * Контроллер обрабатывает посты
 */
class PostController extends Controller
{
    /*
     * Экшен выводит все посты из БД
     */
    public function actionIndex()
    {
        $posts = PostsTable::find();
        $posts_provider = new ActiveDataProvider([
            'query' => $posts,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'post_id' => SORT_DESC,
                ],
            ],
        ]);
        return $this->render('index', compact('posts_provider'));
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
    public function actionCreatePostForm()
    {
        if (Yii::$app->user->isGuest) {
            return Yii::$app->response->redirect('/posts');
        }
        $post_form = new PostForm();
        return $this->render('newPost', compact('post_form')); // надо обработать ошибку при некорректных данных
    }

    /*
     * При успешной валидации добавляет пост в БД
     */
    public function actionCreatePost()
    {
        $post_form = new PostForm();
        if($post_form->load(Yii::$app->request->post()) && $post_form->validate()) {
            $create_post = new PostsTable();
            $create_post->author_id = Yii::$app->user->identity->id;
            $create_post->title = $post_form->title;
            $create_post->short_text = $post_form->short_text;
            $create_post->text = $post_form->text;
            $create_post->save();
            return Yii::$app->response->redirect('/posts');
        }
        return Yii::$app->session->setFlash('error', Html::errorSummary($post_form));//Вывести ошибку валидации
    }
}
