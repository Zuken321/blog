<?php

use yii\helpers\Html;

foreach ($posts as $post):
?>
<div>
    <a href="/posts/<?=Html::encode($post->post_id)?>">
        <h1><?= Html::encode($post->title)?></h1>
        <p><?= Html::encode($post->text)?></p>
    </a>
</div>


<?php endforeach;?>
