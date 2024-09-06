<?php

use app\models\Calendar;
use app\models\db\Tasks;
use app\models\Settings;

$this->title = Settings::getPageTitle('Задачи');

$js = <<< ZZZZZ
(function ($) {
    $(document).on("click", ".get-more-tasks", function() {
        $.get("index.php?r=tasks/ajax-get-more-tasks", {}, function(res) {
            $('.filter-result').html(res);
        });
    }); 
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<script type="text/javascript" src="./js/components/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/table-sort-js/table-sort.js"></script>



<style>
    .form-control {
        border-radius: 12px;
        height: 50px;
    }

    .fc-select {
        height: 50px !important;
    }
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

    .add-task-modal textarea.form-control {
        min-height: 100px;
    }


    .add-task-modal select {
        min-height: 50px;
    }

    .add-task-modal .modal-footer {
        justify-content: center;
        gap: 1.5rem;
    }

    .bg-info {
        background-color: #f8f8f8;
    }

    .today-date{
        background-color: #d0d0d0;
    }

    .get-more-tasks{
        cursor: pointer;
        text-decoration: underline;
        color: dodgerblue;
        font-style: italic;
    }

    .table-sort {
      border: 1px solid rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 2rem;
    }

    .table-sort th{
      padding: 0.3rem 0.7rem;
      background-color: rgba(0, 0, 0, 0.1);
      font-size: 14px;
    }
    .table-sort td{
      border-top: 1px solid  rgba(0, 0, 0, 0.1);
      border-bottom: 1px solid  rgba(0, 0, 0, 0.1);
      padding: 0.3rem 0.7rem;
      vertical-align: top;
    }

    .table-sort tr.red td{
        color: crimson;
    }

    .table-sort tr:first-child td:first-child{
      
    }

    .table-sort tr:first-child td:last-child{
      border-radius: 0 0.5rem 0 0;
    }

    .table-sort tr:last-child td:first-child{
      border-radius: 0 0 0.5rem 0;
    }

    .table-sort tr:last-child td:last-child{
      border-radius: 0 0 0 0.5rem;
    }



</style>
<div class="index-window">
    <!-- 
    <div class="row">
        <div class="day-line">
            <div class="date">23.02.2024</div>
            <div class="one-task row">
                <div class="col-1">
                    <input type="checkbox" class="task-checkbox" data-id="29">
                </div>
                <div class="col-10">
                    <div class="task-content">
                        <p class="h4">Дело о пропаже автомобиля</p>
                        <p class="h5">Составить рапорт по тз</p>
                    </div>
                </div>
                <div class="col-1">
                  <div class="btn">🗑</div>
                  <br>
                  <div class="btn">✎</div>
                </div>
            </div>
        </div>

    </div>
  -->

    <div class="row" style="display: none">
        <div class="col-md-9 my-5">
            <div class="index-window-panel">
                <!-- <span class="index-window-panel-title text-gradient-light-red">Задачи</span> -->
            </div>
        </div>

        <div class="col-md-3 d-none">
            <div style="margin-bottom: 25px">
                <button class="btn btn-success add-task">Добавить задачу</button>
            </div>
        </div>
    </div>

    <div id="right" style="margin-top: 25px">
        <div class="row">

            <div class="col-md-12 text-center"><h4>Задачи</h4></div>
            <div class="col-md-9 action-area">
                <!--                <div class="row" style="margin-top: -23px; margin-bottom: 5px">-->
                <!--                    <div class="col-md-4">-->
                <!--                        <input type="text" class="form-control task-filter tf-title" placeholder="Название задачи">-->
                <!---->
                <!--                    </div>-->
                <!--                    <div class="col-2 text-center ">-->
                <!--                        <input type="date" class="form-control task-filter tf-date">-->
                <!--                    </div>-->
                <!--                    <div class="col-2 text-center ">-->
                <!--                        <select class="form-control fc-select task-filter tf-client">-->
                <!--                            <option value="0">Дело</option>-->
                <!--                            --><?php
                //                            $clients = \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
                //
                //                            foreach ($clients as $client){
                //                                echo "<option value='{$client['id']}'>{$client['family']} {$client['first_name']} {$client['middle_name']}</option>";
                //                            }
                //                            ?>
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                    <div class="col-2 text-center ">-->
                <!--                        <select class="form-control fc-select">-->
                <!--                            <option value="0">Постановщик</option>-->
                <!--                            <option value="1">(я)</option>-->
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                    <div class="col-2 text-center ">-->
                <!--                        <select class="form-control fc-select">-->
                <!--                            <option value="0">Ответственный</option>-->
                <!--                            <option value="1">(я)</option>-->
                <!--                        </select>-->
                <!---->
                <!--                    </div>-->
                <!--                    <div class="col-md-2" hidden>-->
                <!--                        <label>За день</label>-->
                <!--                        <select class="form-control task-filter f-day">-->
                <!--                            <option value="1">1</option>-->
                <!--                            <option value="2">2</option>-->
                <!--                            <option value="3">3</option>-->
                <!--                            <option value="4">4</option>-->
                <!--                            <option value="5">5</option>-->
                <!--                            <option value="6">6</option>-->
                <!--                            <option value="7">7</option>-->
                <!--                            <option value="8">8</option>-->
                <!--                            <option value="9">9</option>-->
                <!--                            <option value="10">10</option>-->
                <!--                            <option value="11">11</option>-->
                <!--                            <option value="12">12</option>-->
                <!--                            <option value="13">13</option>-->
                <!--                            <option value="14">14</option>-->
                <!--                            <option value="15">15</option>-->
                <!--                            <option value="16">16</option>-->
                <!--                            <option value="17">17</option>-->
                <!--                            <option value="18">18</option>-->
                <!--                            <option value="19">19</option>-->
                <!--                            <option value="20">20</option>-->
                <!--                            <option value="21">21</option>-->
                <!--                            <option value="22">22</option>-->
                <!--                            <option value="23">23</option>-->
                <!--                            <option value="24">24</option>-->
                <!--                            <option value="25">25</option>-->
                <!--                            <option value="26">26</option>-->
                <!--                            <option value="27">27</option>-->
                <!--                            <option value="28">28</option>-->
                <!--                            <option value="29">29</option>-->
                <!--                            <option value="30">30</option>-->
                <!--                            <option value="31">31</option>-->
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                    <div class="col-md-2" hidden>-->
                <!--                        <label>За месяц</label>-->
                <!--                        <select class="form-control task-filter f-month">-->
                <!--                            <option value="1">Январь</option>-->
                <!--                            <option value="2">Февраль</option>-->
                <!--                            <option value="3">Март</option>-->
                <!--                            <option value="4">Апрель</option>-->
                <!--                            <option value="5">Май</option>-->
                <!--                            <option value="6">Июнь</option>-->
                <!--                            <option value="7">Июль</option>-->
                <!--                            <option value="8">Август</option>-->
                <!--                            <option value="9">Сентябрь</option>-->
                <!--                            <option value="10">Октябрь</option>-->
                <!--                            <option value="11">Ноябрь</option>-->
                <!--                            <option value="12">Декабрь</option>-->
                <!--                        </select>-->
                <!--                    </div>-->
                <!--                    <div class="col-md-3" hidden>-->
                <!--                        <label>Тип напоминания</label>-->
                <!--                        <select class="form-control task-filter f-type">-->
                <!--                            <option value="1">Все</option>-->
                <!--                            <option value="2">Сотрудникам</option>-->
                <!--                            <option value="3">Личное</option>-->
                <!--                        </select>-->
                <!--                    </div>-->
                <!---->
                <!--                </div>-->
                <div class="col-md-12">
                    <div class="row my-5 ">
                        <style>
                            .blockquote {
                                /* border:  1px solid black!important; */
                            }
                        </style>
                        <!--                        <button class="btn btn-success add-task col-2 p-1">Добавить задачу</button>-->
                        <button class="btn btn-success col-2 p-1" data-bs-toggle="modal" data-bs-target="#order-modal">
                            Добавить задачу
                        </button>

                        <div class="col-1"></div>
                        <!--                        <div class="col-5 p-0">-->
                        <!--                            <input type="text" class="form-control task-filter f-request" placeholder="Поиск">-->
                        <!--                        </div>-->
                        <!-- <div class="col-1 text-center ">
                            <span class="border p-3">
                                Время
                            </span>
                        </div>
                        <div class="col-2 text-center ">
                            <span class="border p-3">
                                Ответственный
                            </span>
                        </div>
                        <div class="col-1 text-center ">
                            <span class="border p-3">
                                Постановщик
                            </span>

                          </div> -->
                    </div>
                </div>



                <div class="filter-result" style="margin-top: 35px">
                    <?php
                    $task_by_days = [];

                    $cr_d = date('d');
                    $cr_m = date('m');
                    $cr_y = date('Y');

                    // $sevenDaysAhead = date('Y-m-d', strtotime('+7 days'));



                    $all_tasks = Tasks::find()
                        ->where(['user_id' => Yii::$app->user->id])
                        ->andWhere(['day' => $cr_d])
                        ->andWhere(['month' => $cr_m])
                        ->andWhere(['year' => $cr_y])
                        //                        ->andWhere(['status' => 1])
                        //                        ->groupBy([
                        //                            'datetime_end',
                        //                            'id',
                        //                        ])
                        ->orderBy(['id' => SORT_DESC])
                        ->asArray()
                        ->all();

                    // группируем по дате
                    foreach ($all_tasks as $data) {
                        $task_by_days[$data['datetime_end']] = $data;
                    }


                    $human_date_format = date('d.m.Y', strtotime($data['datetime_end']));

                    echo '<h4>' . $human_date_format . '</h4>';


                    echo <<<HTML
                    <table class="table-sort table-arrows classes-tables">
                      <thead>
                        <tr>
                          <th>Статус</th>
                          <th>Наименование</th>
                          <th>Время</th>
                          <th>Дело</th>
                          <th>Ответственный</th>
                          <th class="order-by-desc">Постановщик</th>
                        </tr>
                      </thead>
                      <tbody>
                    HTML;

                    // Тут исправил _dayTableLine на _dayLine_table

                    foreach ($task_by_days as $day => $task) {
                        echo $this->render('_dayLine', [
                            'day' => $day,
                        ]);
                    }

                    echo '</tbody>';
                    echo '</table>';

                    ?>
                </div>

            </div>



            <div class="col-md-3" style="text-align: center;">
                <div class="row" hidden>
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
                <div class="text-center  mb-5" style="margin-top: -25px">
                    <?php
                    setlocale(LC_TIME, 'ru_RU.utf8');
                    $date           = strtotime(date('d-m-Y')); // Преобразование строки в timestamp
                    $formatted_date = strftime('%e %B %Y', $date); // Форматирование даты
                    ?>
                    <span class="h4"><span class="welcome-color time_formatter"><?=$formatted_date?></span>
                    <br>
                    <span class="h4" id="item_time"></span>
                </div>

                <div id="calendar" class="calendar w-100">
                    <div class="calendar-title">
                        <div class="calendar-title-text"></div>
                        <div class="calendar-button-group">
                            <button id="prevMonth">&lt;</button>
                            <?php
                            $date = time();
                            $date = date('d/m/Y', $date);
                            $data = explode('/', $date);
                            ?>
                            <button id="today" onclick="showTaskOnDay(<?=$data[0];?>, <?=$data[1];?>)">Сегодня</button>
                            <button id="nextMonth">&gt;</button>
                        </div>
                    </div>
                    <div class="calendar-day-name"></div>
                    <div class="calendar-dates"></div>
                </div>

                <!--                <div class="calendar-nav">-->
                <!--                    <div class="calendar-nav-left"><</div>-->
                <!--                    <div class="calendar-nav-right">></div>-->
                <!--                </div>-->


                <div class="calendars" hidden>
                    <?php
                    $task_dates = Tasks::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

                    $events = [
                        //'25.11' => 'Есть задача',
                    ];

                    foreach ($task_dates as $task_date) {
                        $day_month          = date('d.m', strtotime($task_date['datetime_end']));
                        $events[$day_month] = $task_date['title'];
                    }

                    $prev_month = date("m", strtotime("-1 month"));
                    $cr_month   = date('m');
                    $next_month = date("m", strtotime("+1 month"));

                    echo Calendar::getInterval(date("{$cr_month}.Y"), date("{$cr_month}.Y"), $events);
                    ?>
                </div>
            </div>
        </div>





        <div class="row">
            <div class="col-md-12">
                <div class="get-more-tasks">Показать еще задачи</div>
            </div>
        </div>


    </div>

</div>
<script>
    <?php
    $date = time();
    $date = date('d/m/Y', $date);
    $data = explode('/', $date);
    ?>
    // $.get(`index.php?r=calendar/ajax-get-seven-day&day=<?= $data[0]; ?>&month=<?= $data[1]; ?>&year=<?= $data[2]; ?>`, function(res) {
    //     $('.filter-result').html(res);
    // });


    let btn_delete = document.querySelectorAll('.btn_delete');

    function deleteTask(id) {
        $.get(`index.php?r=calendar/ajax-delete-task&id=${id}/`, function (res) {
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
        $.get(`index.php?r=calendar/ajax-change-task&id=${id}&tasktitle=${tasktitle}&taskdescription=${description}&time=${time}`, function (res) {
            console.log('Обновлена!')
        });

    }
</script>
<script src='https://unpkg.com/dayjs@1.8.21/dayjs.min.js'></script>
<script>
    <?php
    $res = Tasks::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();
    $arr = [];
    foreach ($res as $row) {
        $arr[$row['datetime_end']] = $row['title'];
    }
    $arr = json_encode($arr);
    echo "let events = {$arr}";
    ?>
    // let events = {
    //     "2024-3-6": "Событие 1",
    //     "2024-3-5": ["Событие 2", "Событие 3"]
    //     // Добавьте информацию о событиях на другие даты
    // };

    // взять из бд

    let currentDate = dayjs();
    let daysInMonth = dayjs().daysInMonth();
    let firstDayPosition = dayjs().startOf("month").day();
    let monthNames = [
        "Январь",
        "Февраль",
        "Март",
        "Апрель",
        "Май",
        "Июнь",
        "Июль",
        "Август",
        "Сентябрь",
        "Октябрь",
        "Ноябрь",
        "Декабрь"
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

    weekNames.forEach(function (item) {
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
        prevMonthDateArray.reverse().forEach(function (day) {
            dateElement.innerHTML += `<button class="calendar-dates-day-empty">${day}</button>`;
        });
        //plot current month dates
        for (let i = 0; i < daysInMonth; i++) {

            let _m = currentDate.month() + 1;
            _m = _m.toString().padStart(2, '0');


            let _d = count;
            _d = _d.toString().padStart(2, '0');

            $_da = `${currentDate.year()}-${_m}-${_d}`;
            // console.log($_da);


            let prev = events[$_da] ? events[$_da] : false;
            let show_task = prev ? '' : false; // bg-info (существующие задачи)
            let _link;


            dateElement.innerHTML += `<button class="calendar-dates-day ${show_task}" data-time="${$_da}" onclick="showTaskOnDayByCalendar(${count},${currentDate.month() + 1})">${count++}</button>`;
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


    // show task
    function showTaskOnDayByCalendar(day, month) {
        <?php
        $date = time();
        $date = date('d/m/Y', $date);
        $data = explode('/', $date);
        ?>


        $.get("index.php?r=calendar/ajax-get-one-day", {
            day,
            month
        }, function (res) {
            console.log(res);
            $('.filter-result').html(res);
            // $('.filter-result').append("<button  class='h5 btn mx-auto more_task' onclick='showTaskOnDay(1,1,1)'>Открыть задачи на следующие дни</button>");
            // $('#task_res').html(res);
            $('.f-request').val('');
        });
    }


    function showTaskOnDay(day, month, append = false) {
        console.log('showTaskOnDay')
        <?php
        $date = time();
        $date = date('d/m/Y', $date);
        $data = explode('/', $date);
        ?>

        //if (append) {
        //    $.get(`index.php?r=calendar/ajax-get-seven-day&day=<?//= $data[0] +
        //    1; ?>//&month=<?//= $data[1]; ?>//&year=<?//= $data[2]; ?>//`, function (res) {
        //        $('.filter-result').append(res);
        //        $('.f-request').val('');
        //        $('.more_task').addClass('d-none');
        //        console.log(123);
        //    })
        //} else {
        //    $.get("index.php?r=calendar/ajax-get-one-day", {
        //        day,
        //        month
        //    }, function (res) {
        //        $('.filter-result').html(res);
        //        $('.filter-result').append("<button  class='h5 btn mx-auto more_task' onclick='showTaskOnDay(1,1,1)'>Открыть задачи на следующие дни</button>");
        //        // $('#task_res').html(res);
        //        $('.f-request').val('');
        //    });
        //}
    }


    //highlight current date
    function highlightCurrentDate() {
        dateItems = document.querySelectorAll(".calendar-dates-day");
        if (dateElement && dateItems[currentDate.$D - 1]) {
            dateItems[currentDate.$D - 1].classList.add("today-date");
        }
    }

    //next month button event
    nextMonthButton.addEventListener("click", function () {
        newMonth = currentDate.add(1, "month").startOf("month");
        setSelectedMonth();
    });

    //prev month button event
    prevMonthButton.addEventListener("click", function () {
        newMonth = currentDate.subtract(1, "month").startOf("month");
        setSelectedMonth();
    });

    //today button event
    todayButton.addEventListener("click", function () {
        newMonth = dayjs();
        setSelectedMonth();
        setTimeout(function () {
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
    setTimeout(function () {
        highlightCurrentDate();
    }, 50);


    <?php
    $date = time();
    $date = date('d/m/Y', $date);
    $data = explode('/', $date);
    ?>

    showTaskOnDay(<?= $data[0]; ?>, <?= $data[1]; ?>)
</script>

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

    console.log(newString);

    document.querySelector('.time_formatter').innerText = newString
</script>

<div class="modal fade  add-task-modal" id="order-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавление задачи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-md-12'>
                        <div class="form-group">
                            <label>Название задачи:</label>
                            <input type='text' class='form-control task-title'>
                        </div>

                        <div class="form-group">
                            <label>Описание задачи:</label>
                            <textarea class='form-control task-description' rows="4"></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label>Дата завершения:</label>
                                <input type='date' class='form-control task-date' value="<?=date('Y-m-d')?>">
                            </div>
                            <div class="form-group col">
                                <label>Время:</label>
                                <input type='time' class='form-control task-time' value="00:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ответственный:</label>
                            <select class='form-control task-user'>
                                <option value='<?=Yii::$app->user->id?>'>(себе)</option>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col">
                                <label>Клиент:</label>
                                <select class='form-control new_client_id'>
                                    <option value="0">Выбрать</option>
                                    <?php
                                    $clients =
                                        \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])
                                            ->where(['status_position' => 6])
                                            ->andWhere(['user_id' => Yii::$app->user->id])
                                            ->asArray()
                                            ->all();

                                    foreach ($clients as $client) {
                                        echo "<option value='{$client['id']}'>{$client['family']} {$client['first_name']} {$client['middle_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label>Лид:</label>
                                <select class='form-control new_lead_id'>
                                    <option value="0">Выбрать</option>
                                    <?php
                                    $clients =
                                        \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])
                                            ->where([
                                                '!=',
                                                'status_position',
                                                6,
                                            ])
                                            ->andWhere(['user_id' => Yii::$app->user->id])
                                            ->asArray()
                                            ->all();

                                    foreach ($clients as $client) {
                                        echo "<option value='{$client['id']}'>{$client['family']} {$client['first_name']} {$client['middle_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer pb-0">
                            <button class='btn btn-success save-task'>Сохранить</button>
                            <button class='btn btn-secondary' data-dismiss="modal" onclick="window.location.reload()">
                                Отменить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="/js/components/mixitup/mixitup.min.js"></script>

<script>    
    $(function(){

    }) 
</script>


