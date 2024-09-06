<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\ClientDocuments */

$this->title = 'Create Client Documents';
$this->params['breadcrumbs'][] = ['label' => 'Client Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
