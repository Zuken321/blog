<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\CommentForm;
use app\models\CommentsTable;

/*
 * Контроллер обрабатывает комментарии
 */
class CommentController extends Controller
{
    /*
     * Метод фильтрует данные, полученные с формы комментариев, при успешной валидации добавляет комментарий в БД
     */
    public function actionIndex($post_id)
    {
        $comment_form = new CommentForm();
        if ($comment_form->load(Yii::$app->request->post()) && $comment_form->validate()) {
            $create_comment = new CommentsTable();
            $create_comment->post_id = $post_id;
            $create_comment->author_id = Yii::$app->user->identity->id;
            $create_comment->text = $comment_form->text;
            $create_comment->save();
            return Yii::$app->response->redirect("/post/{$post_id}");
        }
        return Yii::$app->response->redirect("/post/{$post_id}"); // Надо обработать ошибку при проверки валидации
        //return Yii::$app->session->setFlash('error', Html::errorSummary($comment_form));
    }
}