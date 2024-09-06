<?php
$js = <<< ZZZZZ
(function ($) {
    $(document).on("click", ".start-generate", function () {
        var doctype = $('.doctype').val();
        link = 'index.php?r=pdf-creator/' + doctype;
        
        window.location.href = link;
    });
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<div class="index-window">
    <div class="row">
        <div class="col-md-4">
            <label for="client-input" class=" col-form-label">Клиент</label>

            <select class="form-control add-c-client_id" id="client-input">
                <?php
                $clients =
                    \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

                foreach ($clients as $client) {
                    echo "<option value='{$client['id']}'>{$client['family']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputPassword" class="col-form-label">Суд</label>
            <select class="form-control add-c-court_id">
                <?php
                $courts = \app\models\db\CourtsAddresses::find()->asArray()->all();

                foreach ($courts as $court) {
                    if (mb_strlen($court['address']) > 1) {
                        echo "<option value='{$court['id']}'>{$court['name']} - {$court['address']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputPassword" class="col-form-label">Тип документа</label>
            <select class="form-control doctype">
                <?php
                $tmp_file_list = scandir('../views/pdf-creator');
                unset($tmp_file_list[0], $tmp_file_list[1], $tmp_file_list[4], $tmp_file_list[5], $tmp_file_list[59]);

                foreach ($tmp_file_list as $file){
                    $camelKeysName = '';

                    // убираем .php
                    $camelKeysName_tmp = substr($file, 0, -4);

                    // добавляем заглавные
//                    $camelKeysName_tmp = explode('-', $camelKeysName_tmp);
//
//                    foreach ($camelKeysName_tmp as $value){
//                        $camelKeysName .= ucfirst($value);
//                    }

                    echo "<option value='{$camelKeysName_tmp}'>{$file}</option>";
                }
                ?>
            </select>

        </div>
        <div class="col-md-12" style="text-align: right">
            <br>
            <button class="btn btn-success start-generate">Сгенерировать</button>
        </div>
    </div>
</div>