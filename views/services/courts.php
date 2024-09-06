<?php
$js = <<< ZZZZZ
(function ($) {
    $(document).on("keyup", ".court-search", function () {
        var request = $(this).val();
        
        $.get("index.php?r=services/ajax-courts", {request}, function (res) {
            $('.result').html(res);
        });
    });
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">База судов</span>
    </div>

    <input type="text" class="form-control court-search" placeholder="Поиск...">
    <br><br>

    <div class="result">
        <?php
        $courts = \app\models\db\CourtsAddresses::find()->limit(25)->asArray()->all();

        foreach ($courts as $court){
            echo "{$court['region']} {$court['district']} {$court['city']} {$court['name']} {$court['address']}<br><hr>";
        }
        ?>
    </div>
</div>