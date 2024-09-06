<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAsset;
use app\models\User;
use Symfony\Component\BrowserKit\Client;
use yii\helpers\Html;

$clients = \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./js/components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="./js/components/datatables.net-dt/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/tui-date-picker.css">
    <link rel="stylesheet" type="text/css" href="./js/components/tui-calendar/style.css" />
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .calendar-item {
            width: 100%;
            display: inline-block;
            vertical-align: top;
            font: 14px/1.2 Arial, sans-serif;
            margin-top: 25px;
        }

        .calendar-head {
            text-align: center;
            padding: 5px;
            font-weight: 700;
            font-size: 14px;
            display: none;
        }

        .calendar-item table {
            border-collapse: collapse;
            width: 100%;
        }

        .calendar-item th {
            font-size: 12px;
            padding: 6px 7px;
            text-align: center;
            color: #888;
            font-weight: normal;
        }

        .calendar-item td {
            font-size: 13px;
            padding: 10px 5px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .calendar-item tr th:nth-child(6),
        .calendar-item tr th:nth-child(7),
        .calendar-item tr td:nth-child(6),
        .calendar-item tr td:nth-child(7) {
            color: #e65a5a;
        }

        .calendar-day {
            cursor: pointer;
        }

        .calendar-day.last {
            color: #999 !important;
        }

        .calendar-day.today {
            font-weight: bold;
        }

        .calendar-day.event {
            background: #ffe2ad;
            position: relative;
            cursor: pointer;
        }

        .calendar-day.event:hover .calendar-popup {
            display: block;
        }

        .calendar-popup {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            min-width: 200px;
            padding: 15px;
            background: #fff;
            text-align: left;
            font-size: 13px;
            z-index: 100;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: #000;
        }

        .calendar-popup:before {
            content: "";
            border: solid transparent;
            position: absolute;
            left: 8px;
            bottom: 100%;
            border-bottom-color: #fff;
            border-width: 9px;
            margin-left: 0;
        }

        .day-line {
            border: 1px solid #d6d6d6;
            border-radius: 20px;
            padding: 25px 15px;
            margin-bottom: 30px;
        }

        .date {
            margin-top: -37px;
            margin-left: 10px;
            background: white;
            width: 100px;
            text-align: center;
            border: 1px solid #d6d6d6;
            border-radius: 12px;
            margin-bottom: 6px;
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            position: absolute;
            margin-top: 13px;
        }

        .task-content {
            margin-left: 30px;
        }

        .task-complete {
            color: #dfdfdf;
        }

        .calendar-nav {
            display: flex;
            justify-content: space-around;
            cursor: pointer;
            font-family: monospace;
            font-size: 22px;
        }

        .active-day{
            background-color: lightgreen !important;
            color: black
        }
    </style>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="bg-img">
    <?php $this->beginBody() ?>
    <?= $this->render('_parts/_header'); ?>
    <main>
        <div class="index-container">
            <?= $this->render('_parts/_leftNav'); ?>
            <?= $content; ?>
        </div>
    </main>
    <script type="text/javascript" src="./js/components/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="./js/components/datatables.net/js/jquery.dataTables.js"></script>
    <script src="./js/components/tui-code-snippet/dist/tui-code-snippet.min.js"></script>
    <script src="./js/components/tui-time-picker/dist/tui-time-picker.min.js"></script>
    <script src="./js/components/tui-date-picker/dist/tui-date-picker.min.js"></script>
    <script src="./js/components/tui-calendar/dist/tui-calendar.js"></script>
    <script src="./js/components/chance/dist/chance.min.js"></script>
    <script src="./js/components/tui-calendar/moment.min.js"></script>
    <!--    <script src="./js/calendars.js"></script>-->
    <script src="./js/schedules.js"></script>
    <script src="./js/main.js"></script>
    <script>
        // вставляем текущий месяц в фильтр
        $('.f-month').val(<?= date('m') ?>);

        $('.rc-month').val(<?= date('m') ?>);
        $('.rc-year').val(<?= date('Y') ?>);


        <?php /* старое говно
        $(document).on("click", ".add-task", function() {
            $('.action-area').html("<h5>Добавление задачи</h5>" +
                "<div class='row'><div class='col-md-3'></div> <div class='col-md-6'>" +
                "Название задачи:" +
                "<input type='text' class='form-control task-title'><br>" +
                "Описание задачи:" +
                "<textarea class='form-control task-description'></textarea>" +
                "<br>Завершить к дате:<input type='date' class='form-control task-date'>" +
                "<br>Завершить к времени :<input type='time' class='form-control task-time'><br>" +
                "Назначить сотруднику" +
                "<select class='form-control mb-5 task-user'>" +
                "<option value='<?php echo Yii::$app->user->id; ?>'>(себе)</option>" +

                <?php
                if (Yii::$app->user->identity->company_name == 'none') {
                    $company = '';
                } else {
                    $company = Yii::$app->user->identity->company_name;
                }
                $staffs = User::find()->where(['company_name' => $company])->asArray()->all();
                foreach ($staffs as $staff) {
                    echo '"<option value=\'' . $staff['id'] . '\'>' . $staff['username'] . '</option>" + ';
                }
                ?>

                "</select>" + "<div style='text-align: right; margin-top: 15px'>" +
                "<div style='text-align:left;'>Прикрепить к клиенту</div>" +
                "<select class='form-control mb-5 client_id'><?php
                                                                foreach ($clients  as $row) {
                                                                    echo "<option value='{$row['id']}'>{$row['family']} {$row['first_name']} {$row['middle_name']}</option>";
                                                                }
                                                                ?></select>" +
                "<button class='btn btn-success save-task'>Добавить</button>" +
                "</div></div></div>");
        });
 */
        ?>


        // добавление задачи НУЖНОЕ
        $(document).on("click", ".save-task", function() {
            var tasktitle = $('.task-title').val();
            var taskdescription = $('.task-description').val();
            var taskdate = $('.task-date').val();
            var userid = $('.task-user').val();
            var client_id = $('.new_client_id').val();
            var lead_id = $('.new_lead_id').val();
            var tasktime = $('.task-time').val();

            console.log(client_id);
            console.log(lead_id);

            $.get("index.php?r=calendar/add-task", {
                tasktitle,
                taskdescription,
                taskdate,
                userid,
                lead_id,
                client_id,
                tasktime
            }, function(res) {
                //$('.action-area').text('Задача сохранена');
                window.location.reload();
            });
        });

        // чекбокс задачи - задача выполнена
        $(document).on("click", ".task-checkbox", function() {
            var id = $(this).data('id');
            var taskblock = $(this).parent();
            var parent_taskblock = $(this).parent().parent();
            var before_taskblock = $(this).parent().prev();
            var status;

            // if ($(this).is(':checked')) {
            //     status = 0;
            // } else {
            //     status = 1;
            // }
            if ($(this).is(':checked')) {
                status = 1;
            } else {
                status = 0;
            }
            $(taskblock).toggleClass('task-complete');
            // $(parent_taskblock).toggleClass('task-complete');
            //$(before_taskblock).toggleClass('alert');
            //$(before_taskblock).toggleClass('alert-secondary');

            // $(taskblock).toggleClass('alert-info');

            $.get("index.php?r=calendar/task-complete", {
                id,
                status
            }, function(res) {});
        });

        // Фильтрация задач
        function filterTask() {
            var title = $('.tf-title').val();
            var date = $('.tf-date').val();
            var client = $('.tf-client').val();

            $.get("index.php?r=calendar/ajax-search-task", {title, date, client}, function(res) {
                console.log(res);
                $('.filter-result').html(res);
            });
        }

        // подгрузка календаря на определенный месяц
        function getCalendarByOneMonth(month) {
            $.get("index.php?r=calendar/ajax-get-month", {
                month
            }, function(res) {
                $('.calendars').html(res);
            });
        }

        function getCalendarByMonthAndYear(month, year) {
            $.get("index.php?r=calendar/ajax-get-month-and-year", {
                month,
                year
            }, function(res) {
                $('.calendars').html(res);
            });
        }

        $(document).on("change", ".task-filter", function() {
            filterTask();
        }).on("keyup", ".task-filter", function() {
            filterTask();
        });

        $(document).on("change", ".f-month", function() {
            var month = $(this).val();

            getCalendarByOneMonth(month);
        });

        $(document).on("click", ".calendar-nav-left", function() {
            var crmonth = parseInt($('.f-month').val());

            if (crmonth !== 1) {
                crmonth--;
            } else {
                crmonth = 12;
            }

            getCalendarByOneMonth(crmonth);
            $('.f-month').val(crmonth);
        });

        $(document).on("click", ".calendar-nav-right", function() {
            var crmonth = parseInt($('.f-month').val());

            if (crmonth !== 12) {
                crmonth++;
            } else {
                crmonth = 1;
            }

            getCalendarByOneMonth(crmonth);
            $('.f-month').val(crmonth);
        });

        $(document).on("click", ".calendar-day", function() {
            var day = $(this).data('day');
            var month = $(this).data('month');

            $.get("index.php?r=calendar/ajax-get-one-day", {
                day,
                month
            }, function(res) {
                $('.filter-result').html(res);
                $('.f-request').val('');
            });
        });

        /** изменение инпутов справа над календарем */
        $(document).on("change", ".rc-inputs", function() {
            var rc_month = $('.rc-month').val();
            var rc_year = $('.rc-year').val();

            getCalendarByMonthAndYear(rc_month, rc_year);
        });

        /** календарь - подсветка дня при клике */
        $(document).on("click", ".calendar-dates-day", function() {
            $('.calendar-dates-day').removeClass('active-day');
            $(this).addClass('active-day');
        });
    </script>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>