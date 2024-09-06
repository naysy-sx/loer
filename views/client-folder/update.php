<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\ClientFolders */

$this->title = 'Update Client Folders: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Client Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-folders-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
