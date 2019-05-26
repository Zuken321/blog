<?php

/* @var $post_form app\models\PostForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin(['options' => ['class' => 'create-post-form']]);?>
<?= $form->field($post_form, 'title')?>
<?= $form->field($post_form, 'text')->textarea(['rows' => 6])?>
<div class="form-group">
    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end();?>
