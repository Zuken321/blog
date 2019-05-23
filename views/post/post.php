<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="post">
    <h1><?= Html::encode($post->title)?></h1>
    <p><?= Html::encode($post->text)?></p>
    <span>Автор <?= Html::encode($post->users->username)?></span>
</div>

<!--Вынести в отдельный файл -->

<?php if(!Yii::$app->user->isGuest):?>
    <div>
        <h3>Оставить комментарий</h3>
<!--        --><?php //$form = ActiveForm::begin();?>
<!--        --><?//= $form->field($model,'text')?>
<!--        <div class="form-group">-->
<!--            --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-primary'])?>
<!--        </div>-->
<!--        --><?php //ActiveForm::end();?>
    </div>
<?php endif;?>
<div>
    <h3>Комментарии</h3>
<!--    --><?php //if(count($comments) != 0):?>
<!--        --><?php //foreach($comments as $comment):?>
<!--            <div class="comment">-->
<!--                <span>--><?//= Html::encode($comment->users->username)?><!--</span>-->
<!--                <p>--><?//= Html::encode($comment->text)?><!--</p>-->
<!--            </div>-->
<!--        --><?php //endforeach;?>
<!--    --><?php //else:?>
<!--        <span>Нет комментариев</span>-->
<!--    --><?php //endif;?>
</div>