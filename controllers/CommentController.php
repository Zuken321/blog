<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;
use app\models\CommentForm;

/*
 * Контроллер обрабатывает комментарии
 */
class CommentController extends Controller
{
    /*
     * Метод фильтрует данные, полученные с формы комментариев, при успешной валидации добавляет комментарий в БД и
     * перенапрявляет на пост с новым комментарием
     */
    public function actionIndex($post_id)
    {
        $comment_form = new CommentForm();
        if ($comment_form->load(Yii::$app->request->post()) && $comment_form->createComment($post_id)) {
            return Yii::$app->response->redirect("/post/{$post_id}");
        }
        //return Yii::$app->response->redirect("/post/{$post_id}"); // Надо обработать ошибку при проверки валидации
        return Yii::$app->session->setFlash('error', Html::errorSummary($comment_form));
    }
}