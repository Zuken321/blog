<?php

use yii\helpers\Html;
use yii\widgets\ListView;

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', '/new_post');?>
<?php endif; ?>
<?= ListView::widget([
    'dataProvider' => $posts_provider,
    'itemView' => 'postsList',
    'summary' => false,
    'emptyText' => 'Нет постов',
]);?>