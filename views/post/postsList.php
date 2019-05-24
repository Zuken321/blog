<?php

use yii\helpers\Html;

?>
<div class="post">
    <a href="/post/<?=Html::encode($model->post_id)?>">
        <h2><?= Html::encode($model->title)?></h2>
        <span><?= Html::encode($model->users->username)?></span>
        <p><?= Html::encode($model->short_text)?></p>
    </a>
</div>
