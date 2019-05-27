<?php

/** @var $postsProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', ['post/create']);?>
<?php endif; ?>
<?= ListView::widget([
    'dataProvider' => $postsProvider,
    'itemView' => 'postsList',
    'summary' => false,
    'emptyText' => 'Нет постов',
]);?>
