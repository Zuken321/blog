<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PostsTable;
use app\models\CommentsTable;
use app\models\CommentForm;
use app\models\User;
use app\models\PostForm;
use app\models\SignUpForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionPosts()
    {
        if(isset($_GET['post_id']))
        {
            $post_id = $_GET['post_id'];
            $post = PostsTable::find()->where(['post_id' => $post_id])->count()->all();
            if($post != 0)
            {
                $comment_form = new CommentForm();
                if($comment_form->load(Yii::$app->request->post()) && $comment_form->validate())
                {
                    $add_comment = new CommentsTable();
                    $add_comment->post_id = $post_id;
                    $add_comment->author_id = Yii::$app->user->identity->id;
                    $add_comment->text = $comment_form->text;
                    $add_comment->save();
                }
            }
            $post = PostsTable::find()->where(['post_id' => $post_id])->all();
            $comments = CommentsTable::find()->where(['post_id' => $post_id])->orderBy('comment_id DESC')->all();
            return $this->render('post', ['post' => $post, 'comment_form' => $comment_form, 'comments' => $comments]);
        }
        else
        {
            $posts = PostsTable::find()->orderBy('post_id DESC')->all();
            return $this->render('posts', ['posts' => $posts]);
        }
    }
    public function actionNewPost()
    {
        $post_form = new PostForm();
        if($post_form->load(Yii::$app->request->post()) && $post_form->validate())
        {
            $add_post = new PostsTable();
            $add_post->author_id = Yii::$app->user->identity->id;
            $add_post->title = $post_form->title;
            $add_post->short_text = $post_form->short_text;
            $add_post->text = $post_form->text;

            $add_post->save();

            $posts = PostsTable::find()->orderBy('post_id DESC')->all();
            return $this->render('posts', ['posts' => $posts]);
        }
        return $this->render('newPost', ['post_form' => $post_form]);
    }
    public function actionSignUp()
    {
        $signup_form = new SignUpForm();

        if ($signup_form->load(Yii::$app->request->post())) {
            if ($user = $signup_form->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signUp', [
            'signup_form' => $signup_form,
        ]);
    }
}
