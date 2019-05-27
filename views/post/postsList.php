<?php

/** @var app\models\PostsTable $model */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="post">
    <a href="<?= Url::to(['post/view', 'id' => $model->post_id]);?>">
        <h2><?= Html::encode($model->title)?></h2>
        <span><?= Html::encode($model->users->username)?></span>
        <p><?= Html::encode($model->short_text)?></p>
    </a>
</div>
