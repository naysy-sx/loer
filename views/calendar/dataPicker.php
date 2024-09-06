<div id='calendar' class='calendar'>
    <div class='calendar-title'>
      <div class='calendar-title-text'></div>
      <div class='calendar-button-group'>
        <button id='prevMonth'>&lt;</button>
        <button id='today'>Today</button>
        <button id='nextMonth'>&gt;</button>
      </div>
    </div>
    <div class='calendar-day-name'></div>
    <div class='calendar-dates'></div>
  </div>
  <script src='https://unpkg.com/dayjs@1.8.21/dayjs.min.js'></script>
  <script>
    let currentDate = dayjs();
    let daysInMonth = dayjs().daysInMonth();
    let firstDayPosition = dayjs().startOf('month').day();
    let monthNames = [
      'January',
      'February',
      'March',
      'April',
      'May',
      'June',
      'July',
      'August',
      'September',
      'October',
      'November',
      'December'
    ];
    let weekNames = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    let dateElement = document.querySelector('#calendar .calendar-dates');
    let calendarTitle = document.querySelector('.calendar-title-text');
    let nextMonthButton = document.querySelector('#nextMonth');
    let prevMonthButton = document.querySelector('#prevMonth');
    let dayNamesElement = document.querySelector('.calendar-day-name');
    let todayButton = document.querySelector('#today');
    let dateItems = null;
    let newMonth = null;

    weekNames.forEach(function (item) {
      dayNamesElement.innerHTML += `<div>${item}</div>`;
    });

    function plotDays() {
      let count = 1;
      dateElement.innerHTML = '';

      let prevMonthLastDate = currentDate.subtract(1, 'month').endOf('month').$D;
      let prevMonthDateArray = [];

      //plot prev month array
      for (let p = 1; p < firstDayPosition; p++) {
        prevMonthDateArray.push(prevMonthLastDate--);
      }
      prevMonthDateArray.reverse().forEach(function (day) {
        dateElement.innerHTML += `<button class='calendar-dates-day-empty'>${day}</button>`;
      });

      //plot current month dates
      for (let i = 0; i < daysInMonth; i++) {
        dateElement.innerHTML += `<button class='calendar-dates-day'>${count++}</button>`;
      }

      //next month dates
      let diff =
        42 - Number(document.querySelector('.calendar-dates').children.length);
      let nextMonthDates = 1;
      for (let d = 0; d < diff; d++) {
        document.querySelector(
          '.calendar-dates'
        ).innerHTML += `<button class='calendar-dates-day-empty'>${nextMonthDates++}</button>`;
      }

      //month name and year
      calendarTitle.innerHTML = `${monthNames[currentDate.month()]
        } - ${currentDate.year()}`;
    }

    //highlight current date
    function highlightCurrentDate() {
      dateItems = document.querySelectorAll('.calendar-dates-day');
      if (dateElement && dateItems[currentDate.$D - 1]) {
        dateItems[currentDate.$D - 1].classList.add('today-date');
      }
    }

    //next month button event
    nextMonthButton.addEventListener('click', function () {
      newMonth = currentDate.add(1, 'month').startOf('month');
      setSelectedMonth();
    });

    //prev month button event
    prevMonthButton.addEventListener('click', function () {
      newMonth = currentDate.subtract(1, 'month').startOf('month');
      setSelectedMonth();
    });

    //today button event
    todayButton.addEventListener('click', function () {
      newMonth = dayjs();
      setSelectedMonth();
      setTimeout(function () {
        highlightCurrentDate();
      }, 50);
    });

    //set next and prev month
    function setSelectedMonth() {
      daysInMonth = newMonth.daysInMonth();
      firstDayPosition = newMonth.startOf('month').day();
      currentDate = newMonth;
      plotDays();
    }

    //init
    plotDays();
    setTimeout(function () {
      highlightCurrentDate();
    }, 50);



  </script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600&display=swap');




    .calendar {
      max-width: 300px;
      margin: 30px auto;
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
      font-family: 'Manrope', sans-serif;
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
      font-family: 'Manrope', sans-serif;
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
  </style>