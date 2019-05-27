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
     * @param $id integer
     * @return Response|string
     */
    public function actionCreate($id)
    {
        $commentForm = new CommentForm();
        if ($commentForm->load(Yii::$app->request->post())) {
            if($commentForm->createComment($id)) {
                return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
            } else {
                Yii::$app->session->setFlash('error', Html::errorSummary($commentForm));
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        return Yii::$app->response->redirect(Url::to(['post/view', 'id' => $id]));
    }
}