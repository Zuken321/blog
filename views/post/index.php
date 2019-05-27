<?php

/* @var $posts_provider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', Url::to(['post/create']));?>
<?php endif; ?>
<?= ListView::widget([
    'dataProvider' => $posts_provider,
    'itemView' => 'postsList',
    'summary' => false,
    'emptyText' => 'Нет постов',
]);?>
