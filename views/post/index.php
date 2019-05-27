<?php

/** @var yii\data\ActiveDataProvider $postsProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

if(Yii::$app->session->hasFlash('success')) {
    echo Yii::$app->session->getFlash('success');
}

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', ['post/create']);?>
<?php endif; ?>
<?= ListView::widget([
    'dataProvider' => $postsProvider,
    'itemView' => 'postsList',
    'summary' => false,
    'emptyText' => 'Нет постов',
]);?>
