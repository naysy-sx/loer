<?php
//group-inputs inp-fiz
$js = <<< ZZZZZ
(function ($) {
    $('.group-inputs').hide();
    $('.inp-fiz').show();

    $(document).on("click", ".add-person-get-modal", function () {
        $('.client-id').val($(this).data('id'));
    });

    $(document).on("click", ".change-type-form", function () {
        $('.group-inputs').hide();
    
        if ($(this).data('type') == 'f'){ $('.inp-fiz').show(); }
        if ($(this).data('type') == 'j'){ $('.inp-jur').show(); }
        if ($(this).data('type') == 'i'){ $('.inp-ip').show(); }
    });
    
    $('#person-form').submit(function (e) {
            e.preventDefault();
            
            $.ajax({
                url: 'index.php?r=clients/ajax-save-form-persons',
                type: 'get',
                data: $('#person-form').serialize(),
                success: function (res) {
                    //console.log(res);
                    window.location.reload();
                }
            });
    });
    
    $(document).on("change", ".add_c_f", function () { $('.add_c_f').val($(this).val()); });
    $(document).on("change", ".add_c_i", function () { $('.add_c_i').val($(this).val()); });
    $(document).on("change", ".add_c_o", function () { $('.add_c_o').val($(this).val()); });
    
        $('#client-form').submit(function (e) {
            e.preventDefault();
            
            $.ajax({
                url: 'index.php?r=clients/ajax-save-form',
                type: 'get',
                data: $('#client-form').serialize(),
                success: function (res) {
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
<div class="modal fade modal-add persons-add" id="personsAdd" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Добавить участника дела</h5>
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

                    <form id="person-form">
                        <input type="hidden" name="page-refer" value="<?=$_SERVER['REQUEST_URI']?>">
                        <input type="hidden" class="client-id" name="id" value="0">

                        <div class="mb-3 row account-window-tab-flex">
                            <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                            <div class="modal-padding">
                                <label>Процессуальный статус</label>
                                <select class="form-control" name="proc_status">
                                    <option value="1">Истец</option>
                                    <option value="2">Заявитель</option>
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

                            <div class="row min-mb-40">
                                <div class="col-md-5">
                                    <div class="mb-5 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">Адрес регистрации</label>
                                            <input type="text" class="form-control add_c_index" placeholder="Индекс"
                                                   name="reg_addr_index">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="mb-5 row account-window-tab-flex">
                                        <label for="inputTitle" class="col-sm-2 col-form-label"></label>
                                        <div class="modal-padding">
                                            <label class="col-form-label">&nbsp;</label>
                                            <input type="text" class="form-control add_c_address" placeholder="Адрес"
                                                   name="reg_addr">
                                        </div>
                                    </div>
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
                                <div class="input-container">
                                    <label for="inputKPP" class="col-sm-2 col-form-label">КПП</label>
                                    <input type="text" class="form-control form-date add_c_kpp" id="inputKPP"
                                           placeholder="КПП" name="orgkpp">
                                </div>
                            </div>
<!--                            <div class="mb-3 row account-window-tab-flex">-->
<!--                                <label for="inputYrAddress" class="col-sm-2 col-form-label">Юридический адрес</label>-->
<!--                                <div class="modal-flex">-->
<!--                                    <input type="text" class="form-control add_c_jur_addr_index" id="inputIndex"-->
<!--                                           placeholder="Индекс" name="org_jur_addr_index">-->
<!--                                    <input type="text" class="form-control add_c_jur_addr_address" id="inputYrAddress"-->
<!--                                           placeholder="Адрес" name="org_jur_addr">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-check">-->
<!--                                <input class="form-check-input" type="checkbox" value="" id="checkAddress">-->
<!--                                <label class="form-check-label" for="checkAddress">-->
<!--                                    Адрес фактического нахождения организации совпадает с юридическим адресом-->
<!--                                    организации-->
<!--                                </label>-->
<!--                            </div>-->
<!--                            <div class="mb-3 row account-window-tab-flex">-->
<!--                                <label for="inputFactAddress" class="col-sm-2 col-form-label">Адрес-->
<!--                                                                                              местонахождения</label>-->
<!--                                <div class="modal-flex">-->
<!--                                    <input type="text" class="form-control" id="inputIndex2" placeholder="Индекс"-->
<!--                                           name="org_fact_addr_index">-->
<!--                                    <input type="text" class="form-control" id="inputFactAddress" placeholder="Адрес"-->
<!--                                           name="org_jur_addr">-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>

                        <div class="group-inputs inp-ip">
                            <div class="form-button-group">
                                <div class="input-container">
                                    <label for="inputINN" class=" col-form-label">ОГРНИП</label>
                                    <input type="text" class="form-control add_c_orgname" placeholder="ОГРНИП"
                                           name="ogrnip">
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
                                <textarea class="form-control" placeholder="Комментарий"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <!--                <button class="window-buttons-add add custom-btn btn-8 save-client"><span>Добавить</span></button>-->
                <input type="submit" class="window-buttons-add add custom-btn btn-8" value="Добавить">
            </div>
            </form>
        </div>
    </div>
</div>