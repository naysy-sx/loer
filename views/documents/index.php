<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Документы</span>
    </div>
    <div class="case-container">
        <div class="window-buttons">
            <div class="window-buttons-flex">
                <button class="window-buttons-add add custom-btn btn-8" data-bs-toggle="modal"
                        data-bs-target="#docsAdd"><span>Добавить</span></button>
                <div class="window-buttons-group">
                    <button class="window-buttons-action download custom-btn btn btn-success"><span><img src="./img/donwload.png"
                                                                                               alt="download"></span>
                    </button>
                    <button class="window-buttons-action delete custom-btn btn btn-danger"><span><img src="./img/delete.png"
                                                                                             alt="delete"></span>
                    </button>

                </div>
            </div>
            <div class="window-buttons-select">
<span class="dropdown">
<button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button" data-bs-toggle="dropdown"
        aria-expanded="false">
  <span id="calendarTypeName">Кто выдает</span>
</button>
<ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
  <li role="presentation">
      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
          <i class="calendar-icon ic_view_day"></i>Физ. лицо
      </a>
  </li>
  <li role="presentation">
      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
          <i class="calendar-icon ic_view_week"></i>ИП
      </a>
  </li>
  <li role="presentation">
      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
          <i class="calendar-icon ic_view_month"></i>Юр. лицо
      </a>
  </li>
</ul>
</span>
            </div>
        </div>
        <table id="example" class="table table-striped table-bordered docs-table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>№</th>
                <th style="width: 100%">Название</th>
                <th>Кто выдает</th>
                <th style="display: none"></th>
                <th style="display: none"></th>
                <th>Отправить</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td><a href="#">Доверенность по арбитражным делам</a></td>
                <td>ИП</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td><a href="#">Доверенность по гражданским делам</a></td>
                <td>Физ.лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td><a href="#">Доверенность по арбитражным делам</a></td>
                <td>Юр. лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td><a href="#">Доверенность по административным делам</a></td>
                <td>Физ.лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td><a href="#">Доверенность по гражданским делам</a></td>
                <td>ИП</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td><a href="#">Доверенность по административным делам</a></td>
                <td>Юр. лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td><a href="#">Доверенность по административным делам (КАС РФ)</a></td>
                <td>ИП</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td><a href="#">Доверенность по административным делам (КАС РФ)</a></td>
                <td>Физ. лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td><a href="#"> Документ </a></td>
                <td>Физ. лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td><a href="#"> Документ </a></td>
                <td>Юр. лицо</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            <tr>
                <td>11</td>
                <td><a href="#"> Документ </a></td>
                <td>ИП</td>
                <td style="display: none"></td>
                <td style="display: none"></td>
                <td>
                    <button class="table-btn" data-bs-toggle="modal" data-bs-target="#docsSent"><img
                                src="./img/sent.png" alt="edit"></button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="offcanvas offcanvas-end opacity box-edit" data-bs-backdrop="false" tabindex="-1" id="offcanvasRight"
     aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title text-gradient-light-red form-title" id="offcanvasRightLabel">Документ</h5>
        <input type="text" class="form-control form-author" value="Анна Каренина" id="exampleFormControlInput1"
               placeholder="Автор">
        <div class="form-button-group">
            <input type="date" class="form-control form-date" value="12.13.1490" id="exampleFormControlInput1"
                   placeholder="Дата">
            <div class="form-button-select">
            <span class="dropdown">
              <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"
                      data-bs-toggle="dropdown" aria-expanded="false">
                  <span id="calendarTypeName">Статус</span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
                  <li role="presentation">
                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                          <i class="calendar-icon ic_view_day"></i>Срочно
                      </a>
                  </li>
                  <li role="presentation">
                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                          <i class="calendar-icon ic_view_week"></i>В процессе
                      </a>
                  </li>
                  <li role="presentation">
                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                          <i class="calendar-icon ic_view_month"></i>Исправить
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
                          <i class="calendar-icon ic_view_day"></i>Судебные дела
                      </a>
                  </li>
                  <li role="presentation">
                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                          <i class="calendar-icon ic_view_week"></i>Клиенты
                      </a>
                  </li>
                  <li role="presentation">
                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                          <i class="calendar-icon ic_view_month"></i>Документы
                      </a>
                  </li>
              </ul>
          </span>
            </div>
        </div>
        <textarea type="text" class="form-control form-textarea" value="
          " id="exampleFormControlInput1" placeholder="Описание"></textarea>
        <div class="form-button-group">
            <button class="custom-btn btn-8 form-button-btn"><span>Сохранить</span></button>
            <div class="form-button-group-panel">
                <a class="form-button-group-panel-item see"><img src="./img/see.png" alt="see"></a>
                <a class="form-button-group-panel-item edit"><img src="./img/edit.png" alt="edit"></a>
                <button class="form-button-group-panel-item del"><img src="./img/del.png" alt="delete"></button>
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
        <div class="form-comment">
          <textarea type="text" class="form-control form-comment-textarea" id="exampleFormControlInput1"
                    placeholder="Комментарий"></textarea>
            <button class=" custom-btn btn-8 form-comment-btn"><span>Отправить</span></button>
        </div>
    </div>
</div>
<div class="modal fade modal-add" id="docsAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить доверенность</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="account-window-tab-container">
                    <div class="mb-3 row account-window-tab-flex">
                        <label for="inputTitle" class="col-sm-2 col-form-label">Название</label>
                        <div class="">
                            <input type="text" class="form-control" id="inputTitle" placeholder="Название">
                        </div>
                    </div>
                    <div class="modal-radio">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Юр. лицо
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                ИП
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Физ. лицо
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="window-buttons-add add custom-btn btn-8"><span>Загрузить</span></button>
                <button class="window-buttons-add add custom-btn btn-8"><span>Создать</span></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-add modal-sent" id="docsSent" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Отправить доверенность</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="account-window-tab-container">
                    <div class="mb-3 row account-window-tab-flex sent-select">
                        <select class="form-select  account-window-tab-tariff-time"
                                aria-label=".form-select-lg example">
                            <option selected>Кому отправляем?</option>
                            <option value="1">Каренина Анна</option>
                            <option value="2">Обломов Илья</option>
                        </select>
                    </div>
                    <div class="modal-text">
                        <div class="mb-3 row account-window-tab-flex">
                            <label for="inputTitle" class="col-sm-2 col-form-label">Название</label>
                            <div class="">
                                <input type="text" class="form-control" id="inputTitle" placeholder="Название">
                            </div>
                        </div>
                        <div class="mb-3 row account-window-tab-flex">
                            <label for="inputAbout" class="col-sm-2 col-form-label">Комментарий</label>
                            <div class="">
                                    <textarea type="text" class="form-control" id="inputAbout" placeholder="Комментарий"
                                              rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="window-buttons-add add custom-btn btn-8"><span>Отправить</span></button>
            </div>
        </div>
    </div>
</div>