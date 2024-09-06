<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?=$form->field($model, 'username')->textInput(['maxlength' => true])?><br>
            <?=$form->field($model, 'email')->textInput(['maxlength' => true])?><br>
            <?=$form->field($model, 'password_hash')->textInput(['maxlength' => true])?><br>
            <?=$form->field($model, 'city')->textInput(['maxlength' => true])?><br>
            <?=$form->field($model, 'status')->dropDownList([
                10 => 'Включен',
                0  => 'Выключен',
            ])?><br>

            <div class="form-group" style="margin-top: 25px">
                <?=Html::submitButton('Добавить', ['class' => 'btn btn-success'])?>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
<?php ActiveForm::end(); ?>