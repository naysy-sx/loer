<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\ClientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'family') ?>

    <?= $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'middle_name') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'pasport_serial') ?>

    <?php // echo $form->field($model, 'pasport_number') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'proc_status') ?>

    <?php // echo $form->field($model, 'inn') ?>

    <?php // echo $form->field($model, 'ogrn') ?>

    <?php // echo $form->field($model, 'kpp') ?>

    <?php // echo $form->field($model, 'jur_index') ?>

    <?php // echo $form->field($model, 'jur_address') ?>

    <?php // echo $form->field($model, 'fact_index') ?>

    <?php // echo $form->field($model, 'fact_address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'status_position') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
