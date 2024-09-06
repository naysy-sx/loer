<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\ClientFolders */

$this->title = 'Create Client Folders';
$this->params['breadcrumbs'][] = ['label' => 'Client Folders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-folders-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
