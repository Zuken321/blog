<?php

use yii\helpers\Html;

foreach ($records as $record):
?>
<div>
    <a href="/posts/<?=Html::encode($record->record_id)?>">
        <h1><?= Html::encode($record->title)?></h1>
        <p><?= Html::encode($record->text)?></p>
    </a>
</div>


<?php endforeach;?>
