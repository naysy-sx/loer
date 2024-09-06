<?php

use app\models\Settings;
use app\assets\AppAsset;
use app\models\db\Clients;
use app\models\db\Tasks;
use app\models\User;
use Symfony\Component\BrowserKit\Client;
use yii\helpers\Html;

$this->title = Settings::getPageTitle('Моя страница');
?>
<style>
    .fast-action {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: space-evenly;
        align-items: flex-start;
        margin: 15px 0 40px;
    }

    .fast-action .item {
        text-align: center;
        : 1px solid #c9c9c9;
        -radius: 10px;
        padding: 10px;
        width: 15%;
        cursor: pointer;
    }

    .fast-action .item:hover {
        background-color: #f8f8f8;
    }
</style>
<div class="index-window-panel container mx-auto d-none">
    <span class="index-window-panel-title text-gradient-light-red">Здравствуйте,
        <?= Yii::$app->user->identity->username ?>!
    </span>
</div>


<div class="row">
    <div class="col-8 mb-3">
        <div class="fast-action ">
            <div class="item btn btn-success2" onclick="window.location.href='index.php?r=calendar&add=1'">
                <!-- +<br> -->
                <!-- Новое дело -->
                <img src="https://lawico.ru/img/create.png" alt="" class="action_add">
                <p class="h6">
                    Новая задача
                </p>
            </div>
            <div class="item btn btn-success2" onclick="window.location.href='index.php?r=crm/add'">
                <img src="https://lawico.ru/img/create.png" alt="" class="action_add">
                <p class="h6">
                    Новый лид
                </p>
            </div>
            <div class="item btn btn-success2" onclick="window.location.href='index.php?r=clients&add=1'">
                <img src="https://lawico.ru/img/create.png" alt="" class="action_add">
                <p class="h6">
                    Новое дело
                </p>
            </div>
            <div class="item btn btn-success2" onclick="window.location.href='index.php?r=calendar'">
                <img src="https://lawico.ru/img/create.png" alt="" class="action_add">
                <p class="h6">
                    Новая заметка
                </p>
            </div>

            <div class="item btn btn-success2 " onclick="window.location.href='index.php?r=calendar'">
                <img src="https://lawico.ru/img/create.png" alt="" class="action_add">
                <p class="h6">
                    Напоминания
                </p>
            </div>
        </div>
    </div>
    <div class="col-4   mb-3">
        <div class="mt-5 text-center">
            <?php
            setlocale(LC_TIME, 'ru_RU.utf8');
            $date = strtotime(date('d-m-Y')); // Преобразование строки в timestamp
            $formatted_date = strftime('%e %B %Y', $date); // Форматирование даты

            ?>
            <span class="h4"><span class="welcome-color time_formatter"><?= $formatted_date ?></span>
                <br>
                <span class="h4" id="item_time"></span>
        </div>
    </div>
    <div class="col-8">

        <div class="row">
            <div class="col-4 ">
                <div id="container"></div>
            </div>
            <div class="col-4  ">
                <div id="container2"></div>
            </div>
            <div class="col-4  ">
                <div id="container3"></div>
            </div>

            <div class="col-12">
                <div class="col-12 p-5 border border-rounded my-5">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Задачи</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Уведомления</a>

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active py-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="filter-result ">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b><br>order</div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-result">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b><br>order2</div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-result">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b><br>order3</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade py-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="filter-result alert alert-warning">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b></div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-result alert alert-warning">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b></div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-result alert alert-warning">
                                <div class="day-line">
                                    <div class="date">23.02.2024</div>
                                    <div class="one-task">
                                        <div class="task-content"><b> Создана сделка</b></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4  border border-rounded p-5 h-400 d-none" data-calendar>

        <!-- <div id='calendar' class="text-dark">
        </div> -->
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <div class="row">
                    <div class="col-md-6">
                        <select class="form-control rc-inputs rc-month">
                            <option value="1">Январь</option>
                            <option value="2">Февраль</option>
                            <option value="3">Март</option>
                            <option value="4">Апрель</option>
                            <option value="5">Май</option>
                            <option value="6">Июнь</option>
                            <option value="7">Июль</option>
                            <option value="8">Август</option>
                            <option value="9">Сентябрь</option>
                            <option value="10">Октябрь</option>
                            <option value="11">Ноябрь</option>
                            <option value="12">Декабрь</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select class="form-control rc-inputs rc-year">
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </div>
                </div>


                <!--                <div class="calendar-nav">-->
                <!--                    <div class="calendar-nav-left"><</div>-->
                <!--                    <div class="calendar-nav-right">></div>-->
                <!--                </div>-->

                <div class="calendars">
                    <div class="calendar-wrp">
                        <div class="calendar-item">
                            <div class="calendar-head">Февраль 2024</div>
                            <table>
                                <tbody>
                                    <tr>
                                        <th>Пн</th>
                                        <th>Вт</th>
                                        <th>Ср</th>
                                        <th>Чт</th>
                                        <th>Пт</th>
                                        <th>Сб</th>
                                        <th>Вс</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="calendar-day last" data-day="1" data-month="2">1</td>
                                        <td class="calendar-day last" data-day="2" data-month="2">2</td>
                                        <td class="calendar-day last" data-day="3" data-month="2">3</td>
                                        <td class="calendar-day last" data-day="4" data-month="2">4</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-day last" data-day="5" data-month="2">5</td>
                                        <td class="calendar-day last" data-day="6" data-month="2">6</td>
                                        <td class="calendar-day last" data-day="7" data-month="2">7</td>
                                        <td class="calendar-day last" data-day="8" data-month="2">8</td>
                                        <td class="calendar-day last" data-day="9" data-month="2">9</td>
                                        <td class="calendar-day last" data-day="10" data-month="2">10</td>
                                        <td class="calendar-day last" data-day="11" data-month="2">11</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-day last" data-day="12" data-month="2">12</td>
                                        <td class="calendar-day last" data-day="13" data-month="2">13</td>
                                        <td class="calendar-day last" data-day="14" data-month="2">14</td>
                                        <td class="calendar-day last" data-day="15" data-month="2">15</td>
                                        <td class="calendar-day last" data-day="16" data-month="2">16</td>
                                        <td class="calendar-day last" data-day="17" data-month="2">17</td>
                                        <td class="calendar-day last" data-day="18" data-month="2">18</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-day last" data-day="19" data-month="2">19</td>
                                        <td class="calendar-day last" data-day="20" data-month="2">20</td>
                                        <td class="calendar-day last" data-day="21" data-month="2">21</td>
                                        <td class="calendar-day last" data-day="22" data-month="2">22</td>
                                        <td class="calendar-day today event" data-day="23" data-month="2">23<div class="calendar-popup">asd</div>
                                        </td>
                                        <td class="calendar-day " data-day="24" data-month="2">24</td>
                                        <td class="calendar-day " data-day="25" data-month="2">25</td>
                                    </tr>
                                    <tr>
                                        <td class="calendar-day " data-day="26" data-month="2">26</td>
                                        <td class="calendar-day " data-day="27" data-month="2">27</td>
                                        <td class="calendar-day " data-day="28" data-month="2">28</td>
                                        <td class="calendar-day " data-day="29" data-month="2">29</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="calendar-code col-4 ">
        <div id="calendar" class="calendar w-100">
            <div class="calendar-title">
                <div class="calendar-title-text"></div>
                <div class="calendar-button-group">
                    <button id="prevMonth">&lt;</button>
                    <button id="today">Сегодня</button>
                    <button id="nextMonth">&gt;</button>
                </div>
            </div>
            <div class="calendar-day-name"></div>
            <div class="calendar-dates"></div>
        </div>
    </div>
</div>


<!-- grap 3 count -->
<script>
    anychart.onDocumentReady(function() {
        <?php
        $all = Tasks::find()->where(['user_id' => Yii::$app->user->id])->count();
        $task_today = Tasks::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['DATE(datetime_end)' => date('Y-m-d')])
            ->count();
        $task_complete = Tasks::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 1])
            ->count();
        ?>



        // create pie chart with passed data
        var chart = anychart.pie([
            ['Задач на сегодня', <?= $task_today; ?>],
            ['Всего задач', <?= $all; ?>],
            ['Всего задач выполнено', <?= $task_complete; ?>],

        ]);

        chart
            .title('Мои задачи')
            .innerRadius('40%');
        chart.labels().position('outside');
        chart.container('container');
        chart.draw();





        <?php
        $all = Clients::find()->where(['user_id' => Yii::$app->user->id])->count();
        // возможно здесь статус должен быть другой, но пока что просто завершенный это 1
        $client_complete = Clients::find()->where(['user_id' => Yii::$app->user->id])
            ->andWhere(['status' => 1])
            ->count();
        ?>
        // next graph
        var chart2 = anychart.pie([
            ['Дел всего', <?= $all; ?>],
            ['Дел завершено', <?= $client_complete; ?>],

        ]);
        // set chart title text settings
        chart2
            .title('Мои дела')
            // create empty area in pie chart
            .innerRadius('40%');

        // chart2.theme('darkEarth');
        // set chart labels position to outside
        chart2.labels().position('outside');

        // set container id for the chart
        chart2.container('container2');

        // initiate chart drawing
        chart2.draw();





        <?php
        $crm = \app\models\db\Crm::find()
            ->select(['status', 'COUNT(*) AS count'])
            ->where(['status' => [1, 2, 3, 4, 5]])
            ->groupBy('status')
            ->asArray()
            ->all();
        $statuses = [
            '1' => 'Новый',
            '2' => 'В работе',
            '3' => 'Подписание договора',
            '4' => 'Переговоры',
            '5' => 'Завершен',
        ];
        ?>
        var chart3 = anychart.pie([
            ['Новый', <?= $crm[0]['count']; ?>],
            ['В работе', <?= $crm[1]['count']; ?>],
            ['Подписание договора', <?= $crm[2]['count']; ?>],
            ['Переговоры', <?= $crm[3]['count']; ?>],
            ['Завершен', <?= $crm[4]['count']; ?>],
        ]);

        // set chart title text settings
        chart3
            .title('Лиды')
            // create empty area in pie chart
            .innerRadius('40%');

        // chart2.theme('darkEarth');
        // set chart labels position to outside
        chart3.labels().position('outside');

        // set container id for the chart
        chart3.container('container3');

        // initiate chart drawing
        chart3.draw();
    });
</script>

<!-- somecalendar -->
<!-- <script>
    // const calendarEl = document.getElementById('calendar')
    // const calendar = new FullCalendar.Calendar(calendarEl, {
    //     initialView: 'dayGridMonth'
    // })
    // calendar.render()
</script> -->

<!-- notification -->
<script>
    let notification_icon = document.querySelector("#notification_icon");
    // let audio = document.querySelector(".audio_call");
    setTimeout(() => {
        notification_icon.classList.add('notification_call');
        notification_icon.src = './img/bell_active.png';
        // notification_icon.classList.add('bg-danger');

    }, 1000);
</script>



<!-- calendar  -->
<!-- <script>
    //  $.get("index.php?r=calendar/add-task", {})
    // $.get("index.php?r=calendar/ajax-get-calendar", (res) => $('.calendar-code').html(res));
    fetch("index.php?r=calendar/ajax-get-calendar").then(i => i.text()).then(res => {
        $('.calendar-code').html(res)
    })
</script> -->
<script>
    // вставляем текущий месяц в фильтр
    $('.f-month').val(<?= date('m') ?>);

    $('.rc-month').val(<?= date('m') ?>);
    $('.rc-year').val(<?= date('Y') ?>);

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
            "<select class='form-control task-user'>" +
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

            "</select>" +

            "<div style='text-align: right; margin-top: 15px'>" +
            "<button class='btn btn-success2 save-task'>Добавить</button>" +
            "</div></div></div>");
    });

    // добавление задачи
    <?php /* дубль кода отправки модалки
    $(document).on("click", ".save-task", function() {
        var tasktitle = $('.task-title').val();
        var taskdescription = $('.task-description').val();
        var taskdate = $('.task-date').val();
        var tasktime = $('.task-time').val();
        var userid = $('.task-user').val();
        // console.log(tasktime);
        // return 1;
        $.get("index.php?r=calendar/add-task", {
            tasktitle,
            taskdescription,
            taskdate,
            userid,
            tasktime
        }, function(res) {
            //$('.action-area').text('Задача сохранена');
            window.location.reload();
        });
    });
 */ ?>

    // чекбокс задачи - задача выполнена
    $(document).on("click", ".task-checkbox", function() {
        // console.log($(this).data('id'))
        var id = $(this).data('id');
        var taskblock = $(this).parent();
        var status;

        if ($(this).is(':checked')) {
            status = 1;
        } else {
            status = 0;
        }

        $(taskblock).toggleClass('task-complete');

        $.get("index.php?r=calendar/task-complete", {
            id,
            status
        }, function(res) {});
    });

    // Фильтрация задач
    function filterTask() {
        var request = $('.f-request').val();
        var month = $('.f-month').val();

        $.get("index.php?r=calendar/ajax-search-task", {
            request,
            month
        }, function(res) {
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
</script>






<!-- alendar from codepen -->
<script src='https://unpkg.com/dayjs@1.8.21/dayjs.min.js'></script>
<script>
    let currentDate = dayjs();
    let daysInMonth = dayjs().daysInMonth();
    let firstDayPosition = dayjs().startOf("month").day();
    let monthNames = [
        "Январь",
        "Февраль",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];
    let weekNames = ["Пн", "Вт", "Ср", "Чт", "Пт", "Сб", "Вс"];
    let dateElement = document.querySelector("#calendar .calendar-dates");
    let calendarTitle = document.querySelector(".calendar-title-text");
    let nextMonthButton = document.querySelector("#nextMonth");
    let prevMonthButton = document.querySelector("#prevMonth");
    let dayNamesElement = document.querySelector(".calendar-day-name");
    let todayButton = document.querySelector("#today");
    let dateItems = null;
    let newMonth = null;

    weekNames.forEach(function(item) {
        dayNamesElement.innerHTML += `<div>${item}</div>`;
    });

    function plotDays() {
        let count = 1;
        dateElement.innerHTML = "";

        let prevMonthLastDate = currentDate.subtract(1, "month").endOf("month").$D;
        let prevMonthDateArray = [];

        //plot prev month array
        for (let p = 1; p < firstDayPosition; p++) {
            prevMonthDateArray.push(prevMonthLastDate--);
        }
        prevMonthDateArray.reverse().forEach(function(day) {
            dateElement.innerHTML += `<button class="calendar-dates-day-empty">${day}</button>`;
        });

        //plot current month dates
        for (let i = 0; i < daysInMonth; i++) {
            dateElement.innerHTML += `<button class="calendar-dates-day">${count++}</button>`;
        }

        //next month dates
        let diff =
            42 - Number(document.querySelector(".calendar-dates").children.length);
        let nextMonthDates = 1;
        for (let d = 0; d < diff; d++) {
            document.querySelector(
                ".calendar-dates"
            ).innerHTML += `<button class="calendar-dates-day-empty">${nextMonthDates++}</button>`;
        }

        //month name and year
        calendarTitle.innerHTML = `${
    monthNames[currentDate.month()]
  } - ${currentDate.year()}`;
    }

    //highlight current date
    function highlightCurrentDate() {
        dateItems = document.querySelectorAll(".calendar-dates-day");
        if (dateElement && dateItems[currentDate.$D - 1]) {
            dateItems[currentDate.$D - 1].classList.add("today-date");
        }
    }

    //next month button event
    nextMonthButton.addEventListener("click", function() {
        newMonth = currentDate.add(1, "month").startOf("month");
        setSelectedMonth();
    });

    //prev month button event
    prevMonthButton.addEventListener("click", function() {
        newMonth = currentDate.subtract(1, "month").startOf("month");
        setSelectedMonth();
    });

    //today button event
    todayButton.addEventListener("click", function() {
        newMonth = dayjs();
        setSelectedMonth();
        setTimeout(function() {
            highlightCurrentDate();
        }, 50);
    });

    //set next and prev month
    function setSelectedMonth() {
        daysInMonth = newMonth.daysInMonth();
        firstDayPosition = newMonth.startOf("month").day();
        currentDate = newMonth;
        plotDays();
    }

    //init
    plotDays();
    setTimeout(function() {
        highlightCurrentDate();
    }, 50);
</script>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600&display=swap");

    * {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: "Manrope", sans-serif;
        /* background: #ededed; */
    }

    .calendar {
        /* max-width: 500px; */
        /* margin: 0 auto; */
        padding: 20px;
        box-sizing: border-box;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 0px 3px #dadada;
    }

    .calendar .calendar-dates,
    .calendar .calendar-day-name {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-gap: 8px;
    }

    .calendar .calendar-dates-day {
        font-family: "Manrope", sans-serif;
        font-size: 13px;
        border: 1px solid #efefef;
        padding: 4px;
        box-sizing: border-box;

        border-radius: 4px;
        color: #333;
    }

    .calendar .calendar-dates-day-empty {
        background: none;
        border: 0;
        color: #dcdcdc;
        min-height: 28px;
    }

    .calendar .calendar-day-name div {
        text-align: center;
        margin-bottom: 12px;
        font-size: 13px;
        font-weight: 700;
    }

    .calendar .calendar-title {
        padding-bottom: 16px;
        text-align: center;
        font-weight: 500;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
        margin-bottom: 12px;
    }

    .calendar .calendar-dates-day.today-date {

    }

    .calendar #prevMonth,
    .calendar #nextMonth,
    .calendar #today {
        padding: 2px 6px;
        box-sizing: border-box;
        font-family: "Manrope", sans-serif;
        font-size: 20px;
        line-height: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        cursor: pointer;
        color: #333;
    }

    .calendar #today {
        font-size: 13px;
    }

    .calendar .calendar-title-text {
        display: flex;
        align-items: center;
        font-size: 14px;
        font-weight: 700;
    }

    .calendar .calendar-button-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    #nav-tabContent {
        max-height: 400px;
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
<!-- alendar from codepen -->

<!-- script get seven days tasks -->
<script>
    <?php
    $date = time();
    $date =  date('d/m/Y', $date);
    $data = explode('/', $date);
    ?>
    fetch(`index.php?r=calendar/ajax-get-seven-day&day=<?= $data[0]; ?>&month=<?= $data[1]; ?>&year=<?= $data[2]; ?>`).then(i => i.text()).then(res => {
        // $('#nav-home').html(res);
        document.querySelector('#nav-home').innerHTML = `${res}`;
        console.dir(res)
    });





    let btn_delete = document.querySelectorAll('.btn_delete');

    function deleteTask(id) {
        $.get(`index.php?r=calendar/ajax-delete-task&id=${id}/`, function(res) {
            $(`[data-main-${id}]`).remove();
            console.log('Удалена!')
        });
    }



    function changeTask(id) {
        let tasktitle = $(`[data-title-${id}]`).last().text();
        let description = $(`[data-description-${id}]`).last().text();
        // let time = document.querySelector('.time_change').value;
        let time = $(`[data-time-${id}]`).last().val();

        // console.log(time);
        // return 1;
        $.get(`index.php?r=calendar/ajax-change-task&id=${id}&tasktitle=${tasktitle}&taskdescription=${description}&time=${time}`, function(res) {
            console.log('Обновлена!')
        });

    }
</script>


<!-- get notification -->
<script>
    let nav_profile = document.querySelector('#nav-profile');
    fetch('index.php?r=notifications/get-notification').then(i => i.text()).then(res => nav_profile.innerHTML = `${res}`)
</script>


<style>
    .task-checkbox {
        height: 25px !important;
    }
</style>

<!-- time update -->
<script>
    function displayCurrentTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const currentTime = `${hours}:${minutes}`;
        document.querySelector('#item_time').innerText = currentTime;
    }
    displayCurrentTime();
    setInterval(displayCurrentTime, 60000);
</script>

<!-- date formatter -->
<script>
    let originalString = document.querySelector('.time_formatter').innerText;

    let parts = originalString.split(' ');

    let day = parts[0];

    let month = parts[1];

    switch (month) {
        case 'Январь':
            month = 'Января';
            break;
        case 'Февраль':
            month = 'Февраля';
            break;
        case 'Март':
            month = 'Марта';
            break;
        case 'Апрель':
            month = 'Апреля';
            break;
        case 'Май':
            month = 'Мая';
            break;
        case 'Июнь':
            month = 'Июня';
            break;
        case 'Июль':
            month = 'Июля';
            break;
        case 'Август':
            month = 'Августа';
            break;
        case 'Сентябрь':
            month = 'Сентября';
            break;
        case 'Октябрь':
            month = 'Октября';
            break;
        case 'Ноябрь':
            month = 'Ноября';
            break;
        case 'Декабрь':
            month = 'Декабря';
            break;
    }

    let year = parts[2];

    let newString = day + ' ' + month + ' ' + year;

    document.querySelector('.time_formatter').innerText = newString 
</script>