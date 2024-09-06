<?php
//group-inputs inp-fiz
$js = <<< ZZZZZ
(function ($) {
    $('.group-inputs').hide();
    $('.inp-fiz').show();

    $(document).on("click", ".change-type-form", function () {
        $('.group-inputs').hide();

        console.log($('[name="category_id"]').val());

    
        if ($(this).data('type') == 'f'){ $('.inp-fiz').show(); $('[name="category_id"]').val(1); }
        if ($(this).data('type') == 'j'){ $('.inp-jur').show(); $('[name="category_id"]').val(2); }
        if ($(this).data('type') == 'i'){ $('.inp-ip').show(); $('[name="category_id"]').val(3); }
    });

    $('#client-form-2').submit(function (e) {
        e.preventDefault();
        console.log('111');
        $.ajax({
            url: 'index.php?r=clients/ajax-save-form',
            type: 'get',
            data: $('#client-form-2').serialize(),
            success: function (res) {
                console.log('success !!!!');
                window.location.reload();
            }
        });
    });
    
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
<style>
    select {
        height: 50px;
        margin-top: -1px;
    }

    .min-mb-20 {
        margin-bottom: -20px;
    }

    .min-mb-40 {
        margin-bottom: -40px;
    }
</style>
<div class="modal fade modal-add clients-add" id="clientsAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить лида</h5>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="account-window-tab-container">
                    <div class="form-button-group">
                        <!--                        <div class="form-button-select">-->
                        <!--                            <span class="dropdown">-->
                        <!--                              <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"-->
                        <!--                                      data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!--                                  <span id="calendarTypeName">Категория</span>-->
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
                        <!--                                  </li>-->
                        <!--                                  <li role="presentation">-->
                        <!--                                    <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
                        <!--                                        <i class="calendar-icon ic_view_week"></i>ИП-->
                        <!--                                    </a>-->
                        <!--                                </li>-->
                        <!--                              </ul>-->
                        <!--                          </span>-->
                        <!--                            <span class="dropdown">-->
                        <!--                                <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"-->
                        <!--                                        data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!--                                    <span id="calendarTypeName">Процессуальный статус</span>-->
                        <!--                                </button>-->
                        <!--                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">-->
                        <!--                                    <li role="presentation">-->
                        <!--                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">-->
                        <!--                                            <i class="calendar-icon ic_view_day"></i>Не выполнено-->
                        <!--                                        </a>-->
                        <!--                                    </li>-->
                        <!--                                    <li role="presentation">-->
                        <!--                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
                        <!--                                            <i class="calendar-icon ic_view_week"></i>Обратить внимание-->
                        <!--                                        </a>-->
                        <!--                                    </li>-->
                        <!--                                    <li role="presentation">-->
                        <!--                                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">-->
                        <!--                                            <i class="calendar-icon ic_view_month"></i>В процессе-->
                        <!--                                        </a>-->
                        <!--                                    </li>-->
                        <!--                                </ul>-->
                        <!--                              </span>-->
                        <!--                        </div>-->
                    </div>

                    <div style="display: flex">
                        <button class="form-control change-type-form ctf-first" data-type="f">Физ. лицо</button>
                        <button class="form-control change-type-form" data-type="j">Юр. лицо</button>
                        <button class="form-control change-type-form" data-type="i">ИП</button>
                    </div>

                    <form id="client-form-2">
                        <input type="hidden" name="page-refer" value="<?=$_SERVER['REQUEST_URI']?>">
                        <input type="hidden" name="category_id" value="1">

                        <div class="mb-3 row account-window-tab-flex">
                            <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                            <div class="modal-padding">
                                <label>Процессуальный статус</label>
                                <select class="form-control" name="proc_status">

                                    <option value="1">Истец</option>
                                    <option value="1">Заявитель</option>
                                    <option value="1">Ответчик</option>
                                    <option value="1">Прокурор</option>
                                    <option value="1">Третье лицо</option>
                                    <option value="1">Адвокат</option>
                                    <option value="1">Представитель</option>
                                    <option value="1">Свидетель</option>
                                    <option value="1">Специалист</option>
                                    <option value="1">Эксперт</option>
                                    <option value="1">Переводчик</option>
                                    <option value="1">Заинтересованное лицо</option>
                                    <option value="1">Медиатор</option>
                                    <option value="1">Прокурор</option>
                                    <option value="1">Следователь</option>
                                    <option value="1">Руководитель следственного органа</option>
                                    <option value="1">Орган дознания</option>
                                    <option value="1">Начальник подразделения дознания</option>
                                    <option value="1">Начальник органа дознания</option>
                                    <option value="1">Дознаватель</option>
                                    <option value="1">Потерпевший</option>
                                    <option value="1">Частный обвинитель</option>
                                    <option value="1">Гражданский истец</option>
                                    <option value="1">Представители потерпевшего, гражданского истца и частного
                                                      обвинителя
                                    </option>
                                    <option value="1">Подозреваемый</option>
                                    <option value="1">Обвиняемый</option>
                                    <option value="1">Законные представители несовершеннолетнего подозреваемого и
                                                      обвиняемого
                                    </option>
                                    <option value="1">Защитник</option>
                                    <option value="1">Гражданский ответчик</option>
                                    <option value="1">Представитель гражданского ответчика</option>
                                    <option value="1">Свидетель</option>
                                    <option value="1">Лицо, в отношении которого уголовное дело выделено в отдельное
                                                      производство в связи с заключением с ним досудебного соглашения о
                                                      сотрудничестве
                                    </option>
                                    <option value="1">Эксперт</option>
                                    <option value="1">Специалист</option>
                                    <option value="1">Переводчик</option>
                                    <option value="1">Понятой</option>
                                    <option value="1">Административный истец</option>
                                    <option value="1">Административный ответчик</option>
                                    <option value="1">Лицо, в отношении которого ведется производство по делу об
                                                      административном правонарушении
                                    </option>
                                    <option value="1">Потерпевший</option>
                                    <option value="1">Законный представитель физического лица</option>
                                    <option value="1">Законный представитель юридического лица</option>
                                    <option value="1">Защитник и представитель</option>
                                    <option value="1">Уполномоченный при Президенте Российской Федерации по защите прав
                                                      предпринимателей,
                                    </option>
                                    <option value="1">Уполномоченный по защите прав предпринимателей в субъекте
                                                      Российской Федерации
                                    </option>
                                    <option value="1">Свидетель</option>
                                    <option value="1">Понятой</option>
                                    <option value="1">Специалист</option>
                                    <option value="1">Эксперт</option>
                                    <option value="1">Переводчик</option>
                                    <option value="1">Прокурор</option>
                                    <option value="1">Истец</option>
                                    <option value="1">Заявитель</option>
                                    <option value="1">Кредитор</option>
                                    <option value="1">Арбитражный управляющий</option>
                                    <option value="1">Финансовый управляющий</option>
                                    <option value="1">Должник</option>
                                    <option value="1">Третье лицо</option>
                                    <option value="1">Специалист</option>
                                    <option value="1">Эксперт</option>
                                    <option value="1">Заинтересованное лицо</option>

                                </select>
                            </div>
                        </div>

                        <div class="group-inputs inp-fiz">
                            <div class="row min-mb-20">
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Фамилия</label>
                                            <input type="text" class="form-control add_c_f" placeholder="Фамилия"
                                                   name="client_f" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Имя</label>
                                            <input type="text" class="form-control add_c_i" placeholder="Имя"
                                                   name="client_i" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Отчество</label>
                                            <input type="text" class="form-control add_c_o" placeholder="Отчество"
                                                   name="client_o" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row min-mb-40">
                                <div class="col-md-5">
                                    <div class="mb-5 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Адрес регистрации</label>
                                            <input type="text" class="form-control add_c_addr_index" placeholder="Индекс"
                                                   name="reg_addr_index">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-5 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">&nbsp;</label>
                                            <input type="text" class="form-control add_c_addr" placeholder="Адрес"
                                                   name="reg_addr">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="group-inputs inp-ip">
                            <div class="row min-mb-20">
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Фамилия</label>
                                            <input type="text" class="form-control add_c_f" placeholder="Фамилия"
                                                   name="client_f" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Имя</label>
                                            <input type="text" class="form-control add_c_i" placeholder="Имя"
                                                   name="client_i">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Отчество</label>
                                            <input type="text" class="form-control add_c_o" placeholder="Отчество"
                                                   name="client_o">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-button-group">
                                <div class="input-container">
                                    <label for="inputINN" class=" col-form-label">ИНН</label>
                                    <input type="text" class="form-control add_c_inn" placeholder="ИНН" name="orginn">
                                </div>
                                <div class="input-container">
                                    <label for="inputOGRN" class=" col-form-label">ОГРНИП</label>
                                    <input type="text" class="form-control add_c_ogrn" id="inputOGRN"
                                           placeholder="ОГРНИП" name="orgogrn">
                                </div>
                            </div>

                        </div>

                        <div class="group-inputs inp-jur">
                            <div class="form-button-group">
                                <div class="input-container">
                                    <label for="inputINN" class=" col-form-label">Именование организации</label>
                                    <input type="text" class="form-control add_c_orgname" name="orgname"
                                           placeholder="Именование организации">
                                </div>
                            </div>
                            <div class="form-button-group">
                                <div class="input-container">
                                    <label for="inputINN" class=" col-form-label">ИНН</label>
                                    <input type="text" class="form-control add_c_inn" placeholder="ИНН" name="orginn">
                                </div>
                                <div class="input-container">
                                    <label for="inputOGRN" class=" col-form-label">ОГРН</label>
                                    <input type="text" class="form-control add_c_ogrn" id="inputOGRN"
                                           placeholder="ОГРН" name="orgogrn">
                                </div>
                            </div>
                        </div>

                        <div class="form-button-group">
                            <div class="input-container">
                                <label for="inputEmail" class=" col-form-label">Email</label>
                                <input type="email" class="form-control " id="inputEmail" placeholder="Email"
                                       name="email">
                            </div>
                            <div class="input-container">
                                <label for="inputPhone" class=" col-form-label">Телефон</label>
                                <input type="phone" class="form-control " id="inputPhone" placeholder="Телефон"
                                       name="phone">
                            </div>
                        </div>

                        <div class="row" style="margin-top: 25px">
                            <div class="col-md-12">
                                <textarea class="form-control" name="comment" placeholder="Комментарий"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <!--            <div class="modal-footer">-->
            <!--                <input type="submit" class="window-buttons-add add custom-btn btn-8" value="Добавить">-->
            <!--            </div>-->
            <div class="modal-footer pb-0" style="display: block; text-align: center; width: 100%;">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <input type="submit" class='btn btn-success save-task' value="Сохранить" style="height: 37px;
    margin-bottom: 25px;">
                    </div>
                    <div class="col-md-3">
                        <button class='btn btn-secondary' data-dismiss="modal" onclick="window.location.reload()">
                            Отменить
                        </button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>