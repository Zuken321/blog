<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
foreach ($post as $data):?>
    <div>
        <h1><?= Html::encode($data->title)?></h1>
        <p><?= Html::encode($data->text)?></p>
    </div>
<?php endforeach;?>
    <div>
        <?php $form = ActiveForm::begin();?>
        <?= $form->field($model, 'author')?>
        <?= $form->field($model, 'text')?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end();?>
    </div>
<div>
    <?php foreach($comments as $comment):?>
    <div class="comment">
        <span><?= Html::encode($comment->author)?></span>
        <p><?= Html::encode($comment->text)?></p>
    </div>
    <?php endforeach;?>
</div>

