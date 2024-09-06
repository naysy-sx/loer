<?php
$js = <<< ZZZZZ
(function ($) {

})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Почтовая опись</span>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="index.php?r=services/opis-result">
                <input type="hidden" name="r" value="services/opis-result">
            <label>ФИО</label>
            <input type="text" name="fio" class="form-control"><br>

            <label>Организация</label>
            <input type="text" name="org-name" class="form-control"><br>

            <?php
            $i    = 0;
            $stop = 10;

            while ($i < $stop) {
                ?>
                <div class="row">
                    <div class="col-md-8">
                        <label>Наименование</label>
                        <input type="text" class="form-control" name="goods[<?=$i?>][title]"><br>
                    </div>
                    <div class="col-md-2">
                        <label>Кол-во</label>
                        <input type="number" class="form-control" name="goods[<?=$i?>][count]"><br>
                    </div>
                    <div class="col-md-2">
                        <label>Ценность</label>
                        <input type="number" class="form-control" name="goods[<?=$i?>][price]"><br>
                    </div>
                </div>
                <?php $i++;
            } ?>
                <input type="submit" class="btn btn-success" value="Скачать">
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>

</div>