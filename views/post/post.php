<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $post app\models\PostsTable */
/* @var $comments_provider app\models\PostsTable */
?>

<div class="post">
    <h1><?= Html::encode($post->title)?></h1>
    <p><?= Html::encode($post->text)?></p>
    <span>Автор <?= Html::encode($post->users->username)?></span>
</div>

<?php if(!Yii::$app->user->isGuest):?>
    <div>
        <h3>Оставить комментарий</h3>
        <?php $form = ActiveForm::begin(['action' => '/comment/'. $post->post_id]);?>
        <?= $form->field($model,'text')?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary'])?>
        </div>
        <?php ActiveForm::end();?>
    </div>
<?php endif;?>

<div>
    <h3>Комментарии</h3>
    <?= ListView::widget([
        'dataProvider' => $comments_provider,
        'itemView' => 'commentsList',
        'summary' => false,
        'emptyText' => 'Нет комментариев',
    ]);?>
</div>