<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $posts_provider yii\data\ActiveDataProvider */

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', '/create_post');?>
<?php endif; ?>
<?= ListView::widget([
    'dataProvider' => $posts_provider,
    'itemView' => 'postsList',
    'summary' => false,
    'emptyText' => 'Нет постов',
]);?>
