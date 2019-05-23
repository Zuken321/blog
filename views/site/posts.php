<?php

use yii\helpers\Html;
if(!Yii::$app->user->isGuest)
{
    echo '<a href="/new_post">Добавить пост</a>';
}
?>
<?php if(count($posts)):?>
    <?php foreach ($posts as $post):?>
    <div class="post">
        <a href="/posts/<?=Html::encode($post->post_id)?>">
            <h2><?= Html::encode($post->title)?></h2>
            <span><?= Html::encode($post->users->username)?></span>
            <p><?= Html::encode($post->short_text)?></p>
        </a>
    </div>
    <?php endforeach;?>
<?php else:?>
    <p>Нет постов</p>
<?php endif;?>