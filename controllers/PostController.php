<?php

namespace app\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\models\PostForm;
use app\models\PostsTable;

/**
 * Class PostController
 *
 * Контроллер отображает все посты, конкретный пост, создаёт новые посты, редактирует и удаляет их
 *
 * @package app\controllers
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
                'class' => AccessControl::class,
                'only' => ['create', 'update', 'save', 'delete'],
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
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        if (!$post = PostsTable::getPost($id)) {
            throw new NotFoundHttpException('Запрашиваемый пост не найден');
        }
        return $this->render('post', $post);
    }

    /**
     * Отображает страницу создания нового поста
     *
     * @return Response|string
     */
    public function actionCreate()
    {
        $postForm = new PostForm();
        $update = false;
        return $this->render('newPost', compact('postForm', 'update'));
    }

    /**
     * Отображает страницу с формой изменения уже имеющегося поста
     *
     * @param integer $id
     * @return Response|string
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        $post = PostsTable::findOne($id);
        if($post->author_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('У вас недостаточно прав для изменения этой записи');
        }
        $postForm = new PostForm();
        $update = true;
        return $this->render('newPost', compact('postForm', 'update', 'post'));
    }

    /**
     * Сохраняет новый пост, либо изменяет уже имеющийся
     *
     * @param integer|null $id
     * @return Response|string
     * @throws NotFoundHttpException
     */
    public function actionSave($id = null)
    {
        $postForm = new PostForm();
        if(!$postForm->load(Yii::$app->request->post())) {
            throw new NotFoundHttpException('Страница не найдена');
        }
        if(!$postForm->save($id)) {
            Yii::$app->session->setFlash('error', Html::errorSummary($postForm));
            return Yii::$app->request->referrer;
        }
        Yii::$app->session->setFlash('success', 'Статья сохранена');
        if(!$id) {
            return $this->redirect('/posts');
        }
        return $this->redirect(Url::to(['post/view', 'id' => $id]));
    }

    /**
     * Удаляет выбранный пост
     *
     * @param integer $id
     * @return Response
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        $post = PostsTable::findOne($id);
        if($post->author_id != Yii::$app->user->id) {
            throw new ForbiddenHttpException('У вас недостаточно прав для удаления этой записи');
        }
        $post->delete();
        Yii::$app->session->setFlash('success', 'Статья удалена');
        return $this->redirect('/posts');
    }
}
