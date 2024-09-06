<datalist id="court">
    <?php
    $all_courts = \app\models\db\CourtsAddresses::find()->asArray()->all();

    foreach ($all_courts as $court) {
        echo "<option value='{$court['name']}'>";
    }
    ?>
</datalist>

<div class="modal fade modal-add case-add" id="caseAdd" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить дело</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="account-window-tab-container">
                    <label for="client-input" class=" col-form-label">Клиент</label>

                    <select class="form-control add-c-client_id" id="client-input">
                        <?php
                        $clients =
                            \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])->asArray()->all();

                        foreach ($clients as $client) {
                            echo "<option value='{$client['id']}'>{$client['family']}</option>";
                        }
                        ?>
                    </select>

                    <label for="inputPassword" class="col-form-label">Суд</label>
                    <select class="form-control add-c-court_id">
                        <?php
                        $courts = \app\models\db\CourtsAddresses::find()->asArray()->all();

                        foreach ($courts as $court) {
                            if (mb_strlen($court['address']) > 1) {
                                echo "<option value='{$court['id']}'>{$court['name']} - {$court['address']}</option>";
                            }
                        }
                        ?>
                    </select>

                    <div class="form-button-group">
                        <div class="input-container">
                            <label for="inputPassword" class=" col-form-label">Номер дела</label>
                            <input type="text" class="form-control add-c-order-number" id="exampleFormControlInput1"
                                   placeholder="Номер дела">
                        </div>
                        <div class="input-container">
                            <label for="inputPassword" class=" col-form-label">Инстанция</label>
                            <input type="text" class="form-control add-c-instance" id="exampleFormControlInput1"
                                   placeholder="Инстанция">
                        </div>
                    </div>
                    <div class="form-button-group">
                        <div class="input-container">
                            <label for="inputPassword" class=" col-form-label">Статус</label>
                            <select class="form-control order-status add-c-status">
                                <option value="0">Новый</option>
                                <option value="1">В процессе</option>
                                <option value="2">Завершен</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="inputPassword" class="col-form-label add-c-author">Ответственный</label>
                            <select class="form-control order-status">
                                <option value="0">Максим</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-button-group">

                        <!--                        <div class="form-button-select">-->
                        <!--                            <span class="dropdown">-->
                        <!--                              <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8"-->
                        <!--                                      type="button"-->
                        <!--                                      data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!---->
                        <!--                                  <span id="calendarTypeName">Статус</span>-->
                        <!---->
                        <!--                              </button>-->
                        <!--                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">-->
                        <!--                                  <li role="presentation">-->
                        <!--                                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">-->
                        <!--                                          <i class="calendar-icon ic_view_day"></i>Не выполнено-->
                        <!--                                      </a>-->
                        <!--                                  </li>-->
                        <!--                                  <li role="presentation">-->
                        <!--                                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
                        <!--                                          <i class="calendar-icon ic_view_week"></i>Обратить внимание-->
                        <!--                                      </a>-->
                        <!--                                  </li>-->
                        <!--                                  <li role="presentation">-->
                        <!--                                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">-->
                        <!--                                          <i class="calendar-icon ic_view_month"></i>В процессе-->
                        <!--                                      </a>-->
                        <!--                                  </li>-->
                        <!---->
                        <!--                              </ul>-->
                        <!--                            </span>-->
                        <!--                            <span class="dropdown">-->
                        <!--                              <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8"-->
                        <!--                                      type="button"-->
                        <!--                                      data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!---->
                        <!--                                  <span id="calendarTypeName">Категория</span>-->
                        <!---->
                        <!--                              </button>-->
                        <!--                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">-->
                        <!--                                  <li role="presentation">-->
                        <!--                                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">-->
                        <!--                                          <i class="calendar-icon ic_view_day"></i>Физ. лицо-->
                        <!--                                      </a>-->
                        <!--                                  </li>-->
                        <!--                                  <li role="presentation">-->
                        <!--                                      <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
                        <!--                                          <i class="calendar-icon ic_view_week"></i>Юр. лицо-->
                        <!--                                      </a>-->
                        <!--                                  </li>-->
                        <!--                                  <li role="presentation">-->
                        <!--                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
                        <!--                                        <i class="calendar-icon ic_view_week"></i>ИП-->
                        <!--                                    </a>-->
                        <!--                                </li>-->
                        <!---->
                        <!--                              </ul>-->
                        <!--                          </span>-->
                        <!--                        </div>-->
                    </div>
                    <label for="inputPassword" class=" col-form-label">Комментарий</label>
                    <textarea type="text" class="form-control form-textarea add-c-comment" id="exampleFormControlInput1"
                              placeholder="Комментарий"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button class="window-buttons-add add custom-btn btn-8 save-order"><span>Сохранить</span></button>
            </div>
        </div>
    </div>
</div>