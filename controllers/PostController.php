<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\PostForm;
use app\models\PostsTable;

/**
 * Контроллер отображает все посты, конкретный пост, создаёт новые посты, редактирует и удаляет их:
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
                'only' => ['create', 'update', 'delete'],
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
        $postsProvider = new ActiveDataProvider([
            'query' => PostsTable::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'post_id' => SORT_DESC,
                ],
            ],
        ]);
        return $this->render('index', compact('postsProvider'));
    }

    /**
     * Отображает страницу с постом(id): пост, форма добавления коментария и комментарии к прсту
     *
     * @param $id integer
     * @return Response|string
     */
    public function actionView($id)
    {
        $post = PostsTable::getPost($id);
        if ($post != false) {
            return $this->render('post', $post);
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
        $postForm = new PostForm();
        if($postForm->load(Yii::$app->request->post())) {
            if($postForm->createPost()) {
                Yii::$app->session->setFlash('success', 'Статья сохранена');
                return Yii::$app->response->redirect('/posts');
            }
            Yii::$app->session->setFlash('error', Html::errorSummary($postForm));
        }
        $update = false;
        return $this->render('newPost', compact('postForm', 'update'));
    }

    /**
     * Отображает страницу с формой изменения уже имеющегося поста
     *
     * @param $id integer
     * @return Response|string
     */
    public function actionUpdate($id)
    {
        $post = PostsTable::findOne($id);
        if($post->author_id != Yii::$app->user->id) {
            return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
        }
        $postForm = new PostForm();
        if($postForm->load(Yii::$app->request->post()) && $postForm->updatePost($id)) {
            Yii::$app->session->setFlash('success', 'Статья обновлена');
            return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
        }
        $update = true;
        return $this->render('newPost', compact('postForm', 'update', 'post'));
    }

    /**
     * Удаляет выбранный пост
     *
     * @param $id integer
     * @return Response
     * @throws ?
     */
    public function actionDelete($id)
    {
        $post = PostsTable::findOne($id);
        if($post->author_id != Yii::$app->user->id) {
            return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
        }
        $post->delete();
        Yii::$app->session->setFlash('success', 'Статья удалена');
        return Yii::$app->response->redirect('/posts');
    }
}
