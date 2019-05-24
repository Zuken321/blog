<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\CommentForm;

class CommentController extends Controller
{
    public function actionIndex($post_id)
    {
        $comment_form = new CommentForm();
        if ($comment_form->load(Yii::$app->request->post()) && $comment_form->addComment($comment_form, $post_id)) {
            return Yii::$app->response->redirect("/post/{$post_id}");
        }
        return Yii::$app->response->redirect("/post/{$post_id}"); // Надо обработать ошибку при проверки валидации
    }
}
