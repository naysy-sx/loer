<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\db\Clients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(['id' => 'test-add-user']); ?>

<!--    --><?//= $form->field($model, 'company_id')->textInput() ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'family')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'pasport_serial')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'pasport_number')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'proc_status')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'ogrn')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'kpp')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'jur_index')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'jur_address')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'fact_index')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'fact_address')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

<!--    --><?//= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'status_position')->textInput() ?>

    <div class="form-group" style="margin-top: 25px">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
