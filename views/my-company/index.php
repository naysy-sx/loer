<?php

use app\models\Settings;

$this->title = Settings::getPageTitle('Моя компания');

$js = <<< ZZZZZ
(function ($) {
    $(document).on("click", ".save-company", function () {
        var company_name = $('.company-name').text();
        var company_description = $('.company-description').text();
        var inn = $('.i-inn').text();
        var kpp = $('.i-kpp').text();
        var bank = $('.i-bank').text();
        var ks = $('.i-ks').text();
                
        $.get("index.php?r=my-company/ajax-save-data", {company_name, company_description, inn, kpp, bank, ks}, function (res) {
            console.log(res);
            //window.location.reload();
        });
    });
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);

$current_company =
    \app\models\db\Companys::find()->where(['user_id' => Yii::$app->user->id])->asArray()->one();

if (!$current_company) {
    $current_company = [
        'name'        => 'Название компании',
        'description' => 'Описание моей организации',
        'avatar'      => 'https://ifab.se/wp-content/uploads/2019/12/Your_Logo-OUR-PRODUCTS.png',
        'inn'         => '',
        'kpp'         => '',
        'bank'        => '',
        'ks'          => '',
    ];
}
?>
<style>
    .editable {
        border-bottom: 1px solid #bfbfbf;
        margin-bottom: 25px;
    }
</style>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Моя компания</span>
    </div>

    <div class="row nav-margin">
        <div class="col-md-12">
            <?php echo $this->render('//layouts/_parts/_company_nav'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <h1 contenteditable="true" class="company-name"><?=$current_company['name']?></h1>
            <div contenteditable="true" class="company-description">
                <?=$current_company['description']?>
            </div>

            <div class="row" style="width: 50%; margin: 50px auto;">
                <div class="col-md-4">ИНН:</div>
                <div class="col-md-8 editable i-inn" contenteditable="true"><?=$current_company['inn']?></div>
                <div class="col-md-4">КПП:</div>
                <div class="col-md-8 editable i-kpp" contenteditable="true"><?=$current_company['kpp']?></div>
                <div class="col-md-4">Банк:</div>
                <div class="col-md-8 editable i-bank" contenteditable="true"><?=$current_company['bank']?></div>
                <div class="col-md-4">К/С:</div>
                <div class="col-md-8 editable i-ks" contenteditable="true"><?=$current_company['ks']?></div>
            </div>

            <?php
            //echo "<b>" . GetData::getCompanyDataByCurrentUser()->name .
            //    "</b> <a href='#!' style='color: black !important;'>(настроить)</a><hr>";
            //echo "(реквизиты не заполнены)";
            ?>
        </div>
        <div class="col-md-3">
            Лого компании:<br><br>
            <img src="<?=$current_company['avatar']?>" style="width: 100%;">
            <input type="file">
        </div>
        <div class="col-md-12" style="text-align: right">
            <button class="btn btn-success save-company">Сохранить</button>
        </div>
    </div>
</div>