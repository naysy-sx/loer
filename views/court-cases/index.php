<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Таблица дел</span>
    </div>
    <div class="case-container">
        <div class="window-buttons">
            <div class="window-buttons-flex">
                <button class="window-buttons-add add custom-btn btn-8" data-bs-toggle="modal"
                        data-bs-target="#caseAdd"><span>Добавить</span></button>
                <div class="window-buttons-group">
                    <button class="window-buttons-action download custom-btn btn btn-success"><span><img src="./img/donwload.png"
                                                                                               alt="download"></span>
                    </button>
                    <button class="window-buttons-action delete custom-btn btn btn-danger"><span><img src="./img/delete.png"
                                                                                             alt="delete"></span>
                    </button>
                    <!--icons from icons8.ru-->
                </div>
            </div>

            <div class="window-buttons-select">

<span class="dropdown">
<button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">

  <span id="calendarTypeName">Категория</span>

</button>
<ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
  <li role="presentation">
      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
          <i class="calendar-icon ic_view_day"></i>Физ. лицо
      </a>
  </li>
  <li role="presentation">
      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
          <i class="calendar-icon ic_view_week"></i>Юр. лицо
      </a>
  </li>

</ul>
</span>

            </div>

        </div>
        <div id="lnb">
            <div id="lnb-calendars" class="lnb-calendars">

                <div class="lnb-calendars-item position-item left-position">
                    <label>
                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked>
                        <span></span>
                        <strong>Все статусы</strong>
                    </label>

                </div>
                <div id="calendarList" class="lnb-calendars-d1">

                </div>

            </div>
        </div>
        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>
            <tr>
                <th>№</th>
                <th>ФИО/Наименование</th>
                <th>Суд</th>
                <th>Номер дела</th>
                <th>Инстанция</th>
                <th>Дата заседания</th>
                <th>Статус дела</th>
                <th>Комментарий</th>
                <th>Ответственный</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php
            $all_orders =
                \app\models\db\CourtCases::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

            foreach ($all_orders as $order) {
                $client_fio = \app\models\db\Clients::getClientFioInic($order['client_id']);
                $court_name = \app\models\db\CourtsAddresses::find()->where(['id' => $order['court_id']])->one();
                ?>
                <tr>
                    <td><?=$order['id']?></td>
                    <td><a href="#"><?=$client_fio?></a></td>
                    <td><?=$court_name->name?></td>
                    <td><?=$order['case_number']?></td>
                    <td>1</td>
                    <td>1.09.2022</td>
                    <td class="stat1">Ждем суд</td>
                    <td>В работе</td>
                    <td>Максим</td>
                    <td>
                        <button class="table-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                                aria-controls="offcanvasRight"><img src="./img/info.png" alt="edit"></button>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

    </div>
</div>


<div class="offcanvas offcanvas-end opacity box-edit case-edit" data-bs-backdrop="false" tabindex="-1"
     id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="right-panel">
        <div class="offcanvas-header">
            <div class="offcanvas-header-container">
                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title col-3">ФИО/Наименование</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="ФИО/Наименование">Иванов И.И.</textarea>
                    </div>
                </div>
                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Суд</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="Суд">Октябрьский</textarea>
                    </div>
                </div>
                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Номер дела</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="Номер дела">123</textarea>
                    </div>
                </div>

                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Инстанция</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="Инстанция">1</textarea>
                    </div>
                </div>
                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Дата заседания</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="Дата заседания">16.12.1998</textarea>
                    </div>
                </div>
                <div class="form-button-group">

                    <div class="form-button-select">
        <span class="dropdown">
          <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"
                  data-bs-toggle="dropdown" aria-expanded="false">

              <span id="calendarTypeName">Статус</span>

          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
              <li role="presentation">
                  <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                      <i class="calendar-icon ic_view_day"></i>Не выполнено
                  </a>
              </li>
              <li role="presentation">
                  <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                      <i class="calendar-icon ic_view_week"></i>Обратить внимание
                  </a>
              </li>
              <li role="presentation">
                  <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                      <i class="calendar-icon ic_view_month"></i>В процессе
                  </a>
              </li>

          </ul>
        </span>
                        <span class="dropdown">
          <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"
                  data-bs-toggle="dropdown" aria-expanded="false">

              <span id="calendarTypeName">Категория</span>

          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
              <li role="presentation">
                  <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                      <i class="calendar-icon ic_view_day"></i>Физ. лицо
                  </a>
              </li>
              <li role="presentation">
                  <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                      <i class="calendar-icon ic_view_week"></i>Юр. лицо
                  </a>
              </li>

          </ul>
      </span>
                    </div>

                </div>
                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Статус</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1" placeholder="Статус">Ждем суд</textarea>
                    </div>
                </div>

                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Комментарий</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="Комментарий">Готов к созвону</textarea>
                    </div>
                </div>

                <div class="account-window-tab-company ">

                    <span class="account-window-tab-company-title  col-3">Ответственный</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <textarea type="text" class="form-control" id="exampleFormControlInput1"
                                  placeholder="Ответственный">Путин В.В.</textarea>
                    </div>
                </div>

                <div class="form-button-group">
                    <button class="custom-btn btn-8 form-button-btn"><span>Сохранить</span></button>
                </div>
            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Закрыть"></button>
        </div>


        <div class="offcanvas-body">
            <div class="form-history">
                <div class="form-history-container">
                    <ul class="form-history-scroll">
                        <li>
                            <span class="history-item">Создание <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Игорь Петров</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Комментарий <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Игорь Петров</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Игорь Петров</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Игорь Петров</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Анна Каренина</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                        <li>
                            <span class="history-item">Редактирование <span>12.13.1415</span></span>
                            <span class="history-item">Игорь Петров</span>
                            <span class="history-item">"Комментарий"</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>

<?php echo $this->render('_add'); ?>