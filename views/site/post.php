<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
foreach ($post as $data):?>
    <div>
        <h1><?= Html::encode($data->title)?></h1>
        <p><?= Html::encode($data->text)?></p>
    </div>
<?php endforeach;?>
<?php if(!Yii::$app->user->isGuest):?>
    <div>
        <h3>Оставить комментарий</h3>
        <div>
            <?php $form = ActiveForm::begin();?>
            <?= $form->field($model,'text')?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary'])?>
            </div>
            <?php ActiveForm::end();?>
        </div>
    </div>
<?php endif;?>
<div>
    <h3>Комментарии</h3>
    <?php foreach($comments as $comment):?>
        <div class="comment">
            <span><?= Html::encode($comment->users->username)?></span>
            <p><?= Html::encode($comment->text)?></p>
        </div>
    <?php endforeach;?>
</div>

