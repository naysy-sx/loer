<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\db\TemplatesDocs */

$this->title = 'Create Templates Docs';
$this->params['breadcrumbs'][] = ['label' => 'Templates Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="templates-docs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
