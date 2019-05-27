<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\CommentForm;

/**
 * Контроллер обрабатывает добавление новых комментариев
 */
class CommentController extends Controller
{
    /**
     * Добавляет новый комментарий и перенаправляет на страницу с ним
     *
     * @return Response|string
     */
    public function actionCreate($id)
    {
        $comment_form = new CommentForm();
        if ($comment_form->load(Yii::$app->request->post()) && $comment_form->createComment($id)) {
            return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
        }
        //return Yii::$app->response->redirect("/post/{$post_id}"); // Надо обработать ошибку при проверки валидации
        return Yii::$app->session->setFlash('error', Html::errorSummary($comment_form));
    }
}