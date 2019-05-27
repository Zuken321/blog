<?php

/**
 * @var $postForm app\models\PostForm
 * @var $post app\models\PostsTable
 * @var $update app\controllers\PostController
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(['options' => ['class' => 'create-post-form']]);?>
<?php if($update):?>
    <?= $form->field($postForm, 'title')->textInput(['value' => $post->title]);?>
    <?= $form->field($postForm, 'text')->textarea(['rows' => 6, 'value' => $post->text]);?>
    <div class="form-group">
        <?= Html::submitButton('Изменить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php else:?>
    <?= $form->field($postForm, 'title')?>
    <?= $form->field($postForm, 'text')->textarea(['rows' => 6])?>
    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
    </div>
<?php endif;?>
<?php ActiveForm::end();?>