<?php
/**
 * со скрина перенести визуалку
 * 
 */
?>

<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Календарь</span>
    </div>
    <div id="right">
        <div id="menu" class="calendar-menu">
                  <span class="dropdown">
                      <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"
                              data-bs-toggle="dropdown" aria-expanded="false">

                          <span id="calendarTypeName">Dropdown</span>

                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">
                          <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                  <i class="calendar-icon ic_view_day"></i>День
                              </a>
                          </li>
                          <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                  <i class="calendar-icon ic_view_week"></i>Неделя
                              </a>
                          </li>
                          <li role="presentation">
                              <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                  <i class="calendar-icon ic_view_month"></i>Месяц
                              </a>
                          </li>

                      </ul>
                  </span>
            <span id="menu-navi">
                      <button type="button" class="btn btn-default btn-sm move-day custom-btn btn-8"
                              data-action="move-prev">
                          <span class="calendar-icon ic-arrow-line-left" data-action="move-prev">
                            &#10092;</span>
                      </button>
                      <span id="renderRange" class="render-range"></span>
                      <button type="button" class="btn btn-default btn-sm move-day custom-btn btn-8"
                              data-action="move-next">
                          <span class="calendar-icon ic-arrow-line-right" data-action="move-next"> &#10093;</span>
                      </button>
                      <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                      <i class="calendar-icon tui-full-calendar-dropdown-arrow">
                       </i>

                  </span>
        </div>
        <div id="lnb">
            <div id="lnb-calendars" class="lnb-calendars">
                <div class="lnb-calendars-item position-item">
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
        <div class="mb-3 row account-window-tab-flex">
            <div class="col-4">
                <input type="search" class="form-control" id="search" placeholder="Кого ищем?">
            </div>
        </div>
        <div id="calendar"></div>

        <br><br>

        <h5>Список дел</h5>
        Список дел пуст
    </div>
</div>