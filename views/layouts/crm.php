<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?=Yii::$app->language?>">
    <head>
        <meta charset="<?=Yii::$app->charset?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./js/components/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="./js/components/datatables.net-dt/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/tui-time-picker.css">
        <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/tui-date-picker.css">
        <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/style.css"/>
        <link rel="stylesheet" href="./css/styles.css">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?=Html::encode($this->title)?></title>
        <?php $this->head() ?>
        <style>
            .offcanvas-body-scroll {
                color: #656565;
                font-size: 14px;
            }

            .active-type {
                border: 1px solid green !important;
                background-color: #b7d9b7 !important;
            }
        </style>
    </head>
    <body class="bg-img">
    <?php $this->beginBody() ?>
    <?=$this->render('_parts/_header');?>
    <main>
        <div class="index-container">
            <?=$this->render('_parts/_leftNav');?>
            <?=$content;?>
        </div>
    </main>
    <script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
<!--    <script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>-->
    <script src="./js/components/tui-code-snippet/dist/tui-code-snippet.min.js"></script>
    <script src="./js/components/tui-time-picker/dist/tui-time-picker.min.js"></script>
    <script src="./js/components/tui-date-picker/dist/tui-date-picker.min.js"></script>
    <script src="./js/components/tui-calendar/dist/tui-calendar.js"></script>
    <script src="./js/components/chance/dist/chance.min.js"></script>
    <script src="./js/components/tui-calendar/moment.min.js"></script>
    <script src="./js/schedules.js"></script>
    <script src="./js/main.js"></script>



    <script>
        $(document).on("click", ".get-client-data", function() {
            var clientid = $(this).data('id');

            // подгружаем директории
            setTimeout(function() {
                startFolderState();
            }, 500);

            $.get("index.php?r=clients/get-client-info", {
                clientid
            }, function(res) {
                $('.rm-client-info').html(res);
            });
        });

        // создание новой директории
        $(document).on("click", ".add-f-btn", function() {
            var foldername = $('.add-f-name').val();
            var clientid = $('.add-f-client_id').val();

            // создаем
            $.get("index.php?r=folders/create-dir", {
                foldername,
                clientid
            }, function(res) {
                // и подгружаем директории
                setTimeout(function() {
                    startFolderState();
                }, 500);
            });
        });

        // стартовое состояние директорий
        function startFolderState() {
            var clientId = $('.add-f-client_id').val();

            $.get("index.php?r=folders/get-user-folders", {
                clientId
            }, function(res) {
                $(document).find('.folder-area').html(res);
            });
        }

    </script>
    <script>
        // загрузка файлов через ajax
        $(document).on("click", ".load-file", function() {
            var fileblock = $(this).parent().parent().parent().find('.offcanvas-body-scroll').find('.ajax-uploaded-files');
            var file_data = $('.file-input').prop('files')[0];
            var type = $(this).data('type');
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('folderid', $(this).data('id'));
            form_data.append('clientid', $('.add-f-client_id').val());

            $.ajax({
                url: 'index.php?r=folders/upload-file',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(res) {
                    var resdata = jQuery.parseJSON(res);

                    if (resdata.fileName != null) {
                        $(fileblock).append("<a href='" + resdata.filePath + "'><i class='fa fa-file' aria-hidden='true'></i> " + resdata.fileName + "</a><br>");
                    }
                }
            });
        });
    </script>

    <script>
        $('.ctf-first').addClass('active-type');

        // выбор типа заявителя
        $(document).on("click", ".change-type-form", function() {
            var type = $(this).data('type');

            $('.change-type-form').removeClass('active-type');
            $(this).addClass('active-type');

            console.log(type);
        });

        $(document).on("change", ".add_c_f", function () { $('.add_c_f').val($(this).val()); });
        $(document).on("change", ".add_c_i", function () { $('.add_c_i').val($(this).val()); });
        $(document).on("change", ".add_c_o", function () { $('.add_c_o').val($(this).val()); });
        $(document).on("change", ".add_c_orgname", function () { $('.add_c_f').val($(this).val()); });
    </script>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>