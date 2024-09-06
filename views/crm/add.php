<?php

use app\models\Settings;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$clients = \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])->all();
$clients = ArrayHelper::map($clients, 'id', 'family');

$staffs = \app\models\User::find()->where(['company_name' => Yii::$app->user->identity->company_name])->all();
$staffs = ArrayHelper::map($staffs, 'id', 'email');

$this->title = Settings::getPageTitle('CRM - добавление');

$js = <<< ZZZZZ
(function ($) {
    $(document).on("change", "#crm-client_id", function () {
        var opt = document.querySelector('#crm-client_id option:checked');
        $('#crm-client_str').val(opt.text);
    });
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<style>
    table {
        width: 100%;
    }

    td {
        border: 1px solid #d9d9d9;
        padding: 3px 5px;
    }

    .table-header {
        font-weight: 600;
    }

    .margin-v-30 {
        margin: 30px -15px;
    }

    select {
        height: 50px;
    }

    input {
        margin-bottom: 20px;
    }

    .help-block {
        margin: -15px 0 15px;
        color: red;
    }
</style>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">CRM - добавление</span>
    </div>
    <div id="right">
        <div class="row">
            <div class="col-md-12">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">
                    <div class="col-md-4" style="display: none">
                        <?=$form->field($model, 'client_id')->dropDownList($clients, ['prompt' => 'Выберите или введите в следующее поле'])?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'client_str')?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'status')->dropDownList([
                            '1' => 'Новый',
                            '2' => 'В работе',
                            '3' => 'Подписание договора',
                            '4' => 'Переговоры',
                            '5' => 'Завершен',
                        ])?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'worker')->dropDownList($staffs) ?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'refer')->dropDownList([
                            '1' => 'Реклама в интернете',
                            '2' => 'Реклама на тв',
                        ])?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'comment')?>
                    </div>


                    <div class="col-md-4">
                        <?=$form->field($model, 'task')?>
                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'deadline')->input('date')?>
                    </div>
                </div>

                <div class="form-group" style="margin-top: 25px">
                    <?=Html::submitButton('Сохранить', ['class' => 'btn btn-success'])?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>