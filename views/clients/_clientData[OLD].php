      <div class="offcanvas-header">
            <div class="offcanvas-header-container">

                <input type="hidden" class="form-control client-data-id" value="<?=$data->id?>">

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Фамилия</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-family" value="<?=$data->family?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Имя</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-first_name" value="<?=$data->first_name?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Отчество</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-middle_name" value="<?=$data->middle_name?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">ИНН</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-inn" value="<?=$data->inn?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">ОГРН</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-ogrn" value="<?=$data->ogrn?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">КПП</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-kpp" value="<?=$data->kpp?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Юр. адрес, индекс</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-jur_index" value="<?=$data->jur_index?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Юр. адрес</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control client-data-jur_address" value="<?=$data->jur_address?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Комментарий</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control cd-comment client-data-comment"
                               value="<?=$data->comment?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Статус</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <input type="text" class="form-control cd-status client-data-status" value="<?=$data->status?>">
                    </div>
                </div>

                <div class="account-window-tab-company ">
                    <span class="account-window-tab-company-title col-3">Колонка</span>
                    <div class="mb-3 account-window-tab-company-variable">
                        <select class="form-control client-data-status_position">
                            <option value="1" <?php if ($data->status_position == 1) {
                                echo " selected ";
                            } ?>>Новое обращение
                            </option>
                            <option value="2" <?php if ($data->status_position == 2) {
                                echo " selected ";
                            } ?>>Запрос документов
                            </option>
                            <option value="3" <?php if ($data->status_position == 3) {
                                echo " selected ";
                            } ?>>Встреча
                            </option>
                            <option value="4" <?php if ($data->status_position == 4) {
                                echo " selected ";
                            } ?>>Консультация
                            </option>
                            <option value="5" <?php if ($data->status_position == 5) {
                                echo " selected ";
                            } ?>>Не целевой лид
                            </option>
                            <option value="6" <?php if ($data->status_position == 6) {
                                echo " selected ";
                            } ?>>Договор подписан
                            </option>
                            <option value="7" <?php if ($data->status_position == 7) {
                                echo " selected ";
                            } ?>>Сделка сорвалась
                            </option>
                        </select>
                    </div>
                </div>

                <div style="text-align: right">
                    <button class="btn btn-success cd-save-form">Сохранить</button>
                </div>

            </div>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Закрыть"><a href="#!" style="color: transparent;" onclick="window.location.reload()">
                    #!
                </a></button>
        </div>



        <hr>
        <div style="padding: 0 35px; margin-bottom: 10px">Задачи по клиенту:</div>
        <?php
        $tasks_by_current_client = \app\models\db\Tasks::find()->where(['client_id' => $data->id])->asArray()->all();

        foreach ($tasks_by_current_client

                 as $task) { ?>
            <div class="div" style="padding: 35px; margin-top: -35px">
                <div class="row" style="border-radius: 20px; border: 1px solid #ececec; padding: 15px 2px;">
                    <div class="col-md-8">
                        <b><?=$task['title']?></b>
                    </div>
                    <div class="col-md-4" style="text-align: right">
                        <?=date('d.m.Y', $task['datetime'])?>
                    </div>
                    <div class="col-md-12">
                        <?=$task['description']?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <hr>

        <style>
            .persons {
                font-size: 16px;
                padding: 20px;
            }
        </style>

        <div class="offcanvas-body">

            <div class="persons">
                <div>Участники по делу</div>

                <?php
                if (mb_strlen($data->persons) > 1) {
                    $persons = json_decode($data->persons);

                    foreach ($persons as $person) {
                        $rand = rand(10000, 999999);
                        $person = (array)$person;

                        echo '<a class="" data-bs-toggle="collapse" href="#spoiler'.$rand.'"
 role="button" aria-expanded="false" aria-controls="collapseExample">';
                        echo "- {$person['client_f']} {$person['client_i']} {$person['client_o']}<br>";
                        echo '</a>';

                        echo "<div class='collapse' id='spoiler{$rand}'>";
                        echo "<div class='card card-body' style='padding: 15px 7px'>";


                        echo "Фамилия";
                        echo "<input type='text' class='form-control mb-2' value='{$person['client_f']}'>";

                        echo "Имя";
                        echo "<input type='text' class='form-control mb-2' value='{$person['client_i']}'>";

                        echo "Отчество";
                        echo "<input type='text' class='form-control mb-2' value='{$person['client_o']}'>";

                        echo "Дата рождения";
                        echo "<input type='text' class='form-control mb-2' value='{$person['bday']}'>";

                        echo "Пол";
                        echo "<input type='text' class='form-control mb-2' value='{$person['sex']}'>";

                        echo "Адрес регистрации - индекс";
                        echo "<input type='text' class='form-control mb-2' value='{$person['reg_addr_index']}'>";

                        echo "Адрес регистрации";
                        echo "<input type='text' class='form-control mb-2' value='{$person['reg_addr']}'>";

                        echo "Фактический адрес";
                        echo "<input type='text' class='form-control mb-2' value='{$person['fact_addr']}'>";

                        echo "СНИЛС";
                        echo "<input type='text' class='form-control mb-2' value='{$person['snils']}'>";

                        echo "ИНН";
                        echo "<input type='text' class='form-control mb-2' value='{$person['inn']}'>";

                        echo "Тип документа";
                        echo "<input type='text' class='form-control mb-2' value='{$person['doc_type']}'>";

                        echo "Серия документа";
                        echo "<input type='text' class='form-control mb-2' value='{$person['doc_serial']}'>";

                        echo "Номер документа";
                        echo "<input type='text' class='form-control mb-2' value='{$person['doc_num']}'>";

                        echo "E-mail";
                        echo "<input type='text' class='form-control mb-2' value='{$person['email']}'>";

                        echo "Телефон";
                        echo "<input type='text' class='form-control mb-2' value='{$person['phone']}'>";

                        echo "Коммент";
                        echo "<input type='text' class='form-control mb-2' value='{$person['comment']}'>";

                        echo "</div>";
                        echo "</div>";
                    }
                }

                ?>

                <hr>

                <div class="persons-add">
                    <p>
                        <a href="#!" data-bs-toggle="modal" data-bs-target="#personsAdd" class="add-person-get-modal"
                           data-id="<?=$data->id?>">
                            Добавить еще участника дела
                        </a>
                    </p>
                </div>

                <div class="persons-list">
                    <?php
                    // место для js
                    // вывод списка из базы
                    ?>
                </div>
            </div>

            <!--            <div class="form-history">-->
            <!--                <div class="form-history-container">-->
            <!---->
            <!--                    <hr>-->
            <!--                    (?) Может, в такой стилистике и оформить задачи?-->
            <!--                    <hr>-->
            <!---->
            <!--                    <ul class="form-history-scroll">-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Создание <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Игорь Петров</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Комментарий <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Игорь Петров</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Игорь Петров</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Игорь Петров</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Анна Каренина</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                        <li>-->
            <!--                            <span class="history-item">Редактирование <span>12.13.1415</span></span>-->
            <!--                            <span class="history-item">Игорь Петров</span>-->
            <!--                            <span class="history-item">"Комментарий"</span>-->
            <!--                        </li>-->
            <!--                    </ul>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>