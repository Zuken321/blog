<?php

/* @var $post app\models\PostsTable */
/* @var $comments_provider app\models\CommentsTable */
/* @var $comment_form app\models\CommentForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

?>
<?php
    if(!Yii::$app->user->isGuest) {
        if($post->author_id == Yii::$app->user->identity->id) {
            echo Html::a('Редактировать', Url::to(['post/update', 'id' => $post->post_id]));
        }
    }
?>
<div class="post">
    <h1><?= Html::encode($post->title)?></h1>
    <p><?= Html::encode($post->text)?></p>
    <span>Автор <?= Html::encode($post->users->username)?></span>
</div>

<?php if(!Yii::$app->user->isGuest):?>
    <div>
        <h3>Оставить комментарий</h3>
        <?php
            $form = ActiveForm::begin([
                'action' => Url::to(['comment/create', 'id' => $post->post_id]),
                'options' => ['class' => 'comment-form'],
            ]);
        ?>

        <?= $form->field($comment_form,'text')->textarea(['rows' => 2]);?>
        <div class="form-group">
            <?= Html::submitButton('Написать', ['class' => 'btn btn-primary'])?>
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