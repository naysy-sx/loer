<?php
$this->title = 'Дела';
// if(){

// }
$clients = \app\models\db\Clients::find()
    ->where(['user_id' => Yii::$app->user->id])
    ->andWhere(['status_position' => 6])
    ->asArray()
    ->all();

?>
<div class="index-window">
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Дела</span>
    </div>
    <div class="case-container">
        <div class="window-buttons" style="flex-direction: row;">
            <div class="window-buttons-flex">
                <button 
                    class="btn btn-success" 
                    data-bs-toggle="modal" 
                    data-bs-target="#clientsAdd" 
                    id="add_clients"
                    data-bs-backdrop="static" 
                    data-bs-keyboard="false"
                    >
                    <span>Добавить</span>
                </button>
                <!--                <div class="window-buttons-group">-->
                <!--                    <button class="window-buttons-action download custom-btn btn-8"><span><img-->
                <!--                                    src="./img/donwload.png" alt="download"></span></button>-->
                <!--                    <button class="window-buttons-action delete custom-btn btn-8"><span><img-->
                <!--                                    src="./img/delete.png" alt="delete"></span></button>-->
                <!---->
                <!--                </div>-->
            </div>

            <!--            <div class="window-buttons-select">-->
            <!--                      <span class="dropdown">-->
            <!--                          <button id="dropdownMenu-calendarType" class="dropdown-toggle custom-btn btn-8" type="button"-->
            <!--                                  data-bs-toggle="dropdown" aria-expanded="false">-->
            <!--                            <span id="calendarTypeName">Категория</span>-->
            <!--                          </button>-->
            <!--                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu-calendarType">-->
            <!--                            <li role="presentation">-->
            <!--                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">-->
            <!--                                    <i class="calendar-icon ic_view_day"></i>Физ. лицо-->
            <!--                                </a>-->
            <!--                            </li>-->
            <!--                            <li role="presentation">-->
            <!--                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">-->
            <!--                                    <i class="calendar-icon ic_view_week"></i>Юр. лицо-->
            <!--                                </a>-->
            <!--                            </li>-->
            <!--                            <li role="presentation">-->
            <!--                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">-->
            <!--                                    <i class="calendar-icon ic_view_month"></i>ИП-->
            <!--                                </a>-->
            <!--                            </li>-->
            <!--                          </ul>-->
            <!--                      </span>-->
            <!--            </div>-->
        </div>


        <style>
            .modal-dialog{
                max-width: 855px;
            }
            .client-table {
                width: 100%;
            }
            .client-table a{
              color: dodgerblue;
              text-decoration: underline;
            }
            .client-table a:hover{
              color: ;
              text-decoration: none;
            }
            .client-table th:nth-child(2),
            .client-table td:nth-child(2){
                min-width: 200px;
            }

            .client-table th{
              font-size: 14px;
            }

            .client-table td{
              font-size: 12px;
            }
            .client-table td:nth-child(1),
            .client-table td:nth-child(2){
              font-size: 16px;
              line-height: 1.2;
            }

            .table-btn {
                cursor: pointer;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/table-sort-js/table-sort.min.js"></script>

        <table class="table table-sort table-arrows client-table">
          <thead>
            <tr style="background-color: #f1f1f1">
              <th scope="col">№</th>
              <th scope="col">ФИО/Наименование</th>
              <th scope="col">Суд</th>
              <th scope="col">Номер дела</th>
              <th scope="col">Инстанция</th>
              <th scope="col">Дата заседания</th>
              <th scope="col">Ответственный</th>
              <th scope="col" class="text-center">Статус дела</th>
              <th scope="col" class="text-center">Категория</th>
            </tr>
            <!--
            <tr>
              <td colspan="2"><input type='text' class="form-control" placeholder="Поиск по ФИО"></td>
              <td><input type='text' class="form-control" placeholder="Суд"></td>
              <td><input type='text' class="form-control" placeholder="Номеру дела"></td>
              <td><input type='text' class="form-control" placeholder="Инстанции"></td>
              <td><input type='date' class="form-control"></td>
              <td><input type='text' class="form-control" placeholder="Ответственному"></td>
              <td class="text-center"><input type='text' class="form-control" placeholder="Статусу"></td>
              <td class="text-center">Заметка</td>
              <td class="text-center"><input type='text' class="form-control" placeholder="Типу"></td>
            </tr>-->
          </thead>

          <tbody>
            <?php

            foreach ($clients as $client) {
            ?>
                <tr class="table-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-id="<?= $client['id'] ?>">
                    <td scope="col"><?= $client['id'] ?></td>
                    <td><?= $client['family'] ?> <?= $client['first_name'] ?> <?= $client['middle_name'] ?></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"><?= $client['status'] ?></td>
                    <!--                    <td class="text-center">--><? //=$client['comment']
                                                                        ?><!--</td>-->
                    <td class="text-center">Физ. лицо</td>
                </tr>
            <?php } ?>

          </tbody>
        </table>

    </div>
</div>


<div class="modal fade modal-add modal-sent" id="docsSent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog w-75">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Отправить доверенность</h5>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body ">
                <div class="account-window-tab-container">
                    <div class="mb-3 row account-window-tab-flex sent-select">
                        <select class="form-select  account-window-tab-tariff-time" aria-label=".form-select-lg example">
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
                                <textarea type="text" class="form-control" id="inputAbout" placeholder="Комментарий" rows="5"></textarea>
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

<div class="offcanvas offcanvas-end opacity box-edit box-client row" data-bs-backdrop="false" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="rm-client-info"></div>
</div>

<?php echo $this->render('_add'); ?>
<?php echo $this->render('_addPerson'); ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
