<?php

/**
 * @var app\models\PostForm $postForm
 * @var app\models\PostsTable $post
 * @var bool $update
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if(Yii::$app->session->hasFlash('error')) {
    echo Yii::$app->session->getFlash('error');
}
?>

<?php $form = ActiveForm::begin(['action' => ['post/save', 'id' => $postForm->postId], 'options' => ['class' => 'create-post-form']]);?>
    <?= $form->field($postForm, 'title')->textInput(['value' => $postForm->title]);?>
    <?= $form->field($postForm, 'text')->textarea(['rows' => 6, 'value' => $postForm->text]);?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end();?>
