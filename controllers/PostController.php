<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\PostForm;
use app\models\PostsTable;

/**
 * Контроллер отображает страницу:
 * 1) Со всеми постами;
 * 2) С конкретный постом и комментариями к нему;
 * 3) Создания нового поста.
 */
class PostController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Отображает страницу со всеми постами
     *
     * @return string
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

    /**
     * Отображает страницу с постом(id): пост, форма добавления коментария и комментарии к прсту
     *
     * @param $id integer
     * @return Response|string
     */
    public function actionView($id)
    {
        if (isset($id)) {
            $post = PostsTable::getPost($id);
            if ($post != false) {
                return $this->render('post', $post);
            }
        }
        return Yii::$app->response->redirect('/posts');
    }

    /**
     * Отображает страницу создания нового поста
     *
     * @return Response|string
     */
    public function actionCreate()
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
