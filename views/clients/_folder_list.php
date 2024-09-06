<?php
/* @var $folders app\models\db\ClientFolders[] */

use yii\helpers\Html;

foreach ($folders as $folder) {
    echo Html::tag('div', Html::encode($folder->title), ['class' => 'folder-item']);
}