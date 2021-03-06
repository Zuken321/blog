<?php

/** @var $signUpForm app\models\SignUpForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($signUpForm, 'username')->textInput(['autofocus' => true]) ?>
            <?= $form->field($signUpForm, 'password')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton('Загеристироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
