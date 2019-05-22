<?php

use yii\helpers\Html;

foreach ($posts as $post):
?>
<div class="post">
    <a href="/posts/<?=Html::encode($post->post_id)?>">
        <h2><?= Html::encode($post->title)?></h2>
        <p><?= Html::encode($post->short_text)?></p>
    </a>
</div>

<?php endforeach;?>
