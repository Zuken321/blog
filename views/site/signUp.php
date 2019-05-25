<?php

/* @var $signup_form app\models\SignUpForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($signup_form, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($signup_form, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Загеристироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>