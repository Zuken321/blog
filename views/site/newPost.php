<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (Yii::$app->user->isGuest) {
    // сделать редирект на posts
    //return
}
?>
<?php $form = ActiveForm::begin();?>
<?= $form->field($post_form, 'title')?>
<?= $form->field($post_form, 'short_text')?>
<?= $form->field($post_form, 'text')?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>
