<?php

use yii\helpers\Html;
use yii\widgets\ListView;

if(!Yii::$app->user->isGuest): ?>
    <?= Html::a('Добавить пост', '/new_post');?>
<?php endif; ?>

<?php if(count($posts_provider)):?>
    <?= ListView::widget([
        'dataProvider' => $posts_provider,
        'itemView' => 'postsList',
    ]);?>
<?php else:?>
    <p>Нет постов</p>
<?php endif;?>