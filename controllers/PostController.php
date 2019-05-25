<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\PostForm;
use app\models\PostsTable;

/*
 * Контроллер обрабатывает посты
 */
class PostController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create-post'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

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
     * Экшен выводит из БД пост(с указзанным id), форму добавления комментария и комментарии к посту
     */
    public function actionPost($post_id)
    {
        if (isset($post_id)) {
            $post = PostsTable::getPost($post_id);

            if ($post != false) {
                return $this->render('post', $post);
            }
        }
        return Yii::$app->response->redirect('/posts');
    }

    /*
     * Экшен отображает форму добавления постов, при отправки формы обрабатывает данные,
     * при успешной валидации добавляет пост в БД
     */
    public function actionCreatePost()
    {
        $post_form = new PostForm();
        if($post_form->load(Yii::$app->request->post())) {
            if($post_form->createPost()) {
                return Yii::$app->response->redirect('/posts');
            }
            return Yii::$app->session->setFlash('error', Html::errorSummary($post_form));//Вывести ошибку валидации
        }
        return $this->render('newPost', compact('post_form'));
    }
}
