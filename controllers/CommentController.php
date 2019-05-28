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
 * @package app\controllers
 */
class CommentController extends Controller
{
    /**
     * Добавляет новый комментарий и перенаправляет на страницу с ним
     *
     * @param integer $id
     * @return Response|string
     */
    public function actionCreate($id)
    {
        $commentForm = new CommentForm();
        if ($commentForm->load(Yii::$app->request->post()) && !$commentForm->createComment($id)) {
            Yii::$app->session->setFlash('error', Html::errorSummary($commentForm));
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(Url::to(['post/view', 'id' => $id]));

    }
}
