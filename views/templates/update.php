<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\TemplatesDocs */

$this->title = 'Update Templates Docs: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Templates Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="templates-docs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
