<?php
use yii\helpers\Html;

?>
<div class="comment">
    <span><?= Html::encode($model->users->username)?></span>
    <p><?= Html::encode($model->text)?></p>
</div>