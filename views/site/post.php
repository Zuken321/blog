<?php

use yii\helpers\Html;

foreach ($records as $record):
    ?>
    <div>
            <h1><?= Html::encode($record->title)?></h1>
            <p><?= Html::encode($record->text)?></p>
        </a>
    </div>
<?php endforeach;?>
