<?php
$this->title = 'Помощь';
?>
<div class="index-window" hidden>
    <div class="index-window-panel">
        <span class="index-window-panel-title text-gradient-light-red">Помощь</span>
    </div>

    <style>
        .q-card {
            width: 100%;
            padding: 15px 25px;
            border: 1px solid gainsboro;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .q-card:hover .q-description {
            display: block;
        }

        .q-description {
            display: none;
            border-top: 1px solid gainsboro;
            padding-top: 15px;
        }

        .q-title {
            font-weight: 700;
        }
    </style>


    <?php
    $i    = 1;
    $stop = 10;

    while ($i < $stop) {
    ?>
        <div class="q-card">
            <div class="q-title">Текстовое описание вопроса</div>
            <div class="q-description">
                Текстовое описание ответа №<?= $i ?> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, dolor dolorem
                earum eligendi facilis illo, maiores nisi omnis pariatur perferendis possimus quas quo saepe sapiente
                sed tempora, ullam velit voluptas.
            </div>
        </div>
    <?php $i++;
    } ?>

    <div class="q-card">
        <div class="q-title">Все еще остались вопросы?</div>
        Вы можете задать вопрос через форму обратной связи в правом нижнем углу
    </div>
</div>
<div class="container mx-auto mt-5 p-5 bg-light text-center">
    <h2 class="display-5 border p-1">Справочный центр Лавико</h2>




    <div class="d-flex align-items-start mt-5">
        <div class="nav flex-column nav-pills me-3 border p-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link m-1 bg-light text-secondary active" id="v-pills-start-tab" data-bs-toggle="pill" data-bs-target="#v-pills-start" type="button" role="tab" aria-controls="v-pills-start" aria-selected="true">С чего начать</button>

            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-main-tab" data-bs-toggle="pill" data-bs-target="#v-pills-main" type="button" role="tab" aria-controls="v-pills-main" aria-selected="false">Главная</button>




            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-tasks-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tasks" type="button" role="tab" aria-controls="v-pills-tasks" aria-selected="false">Задачи</button>



            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-crm-tab" data-bs-toggle="pill" data-bs-target="#v-pills-crm" type="button" role="tab" aria-controls="v-pills-crm" aria-selected="false">CRM</button>


            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-work-tab" data-bs-toggle="pill" data-bs-target="#v-pills-work" type="button" role="tab" aria-controls="v-pills-work" aria-selected="false">Дела</button>

            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-services-tab" data-bs-toggle="pill" data-bs-target="#v-pills-services" type="button" role="tab" aria-controls="v-pills-services" aria-selected="false">Сервисы</button>


            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-company-tab" data-bs-toggle="pill" data-bs-target="#v-pills-company" type="button" role="tab" aria-controls="v-pills-company" aria-selected="false">Компания</button>


            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Настройки</button>

            <button class="nav-link m-1 bg-light text-secondary" id="v-pills-tarif-tab" data-bs-toggle="pill" data-bs-target="#v-pills-tarif" type="button" role="tab" aria-controls="v-pills-tarif" aria-selected="false">Тарифы</button>
        </div>

        <div class="tab-content  w-100 h-100" id="v-pills-tabContent">


            <div class="tab-pane fade show active" id="v-pills-start" role="tabpanel" aria-labelledby="v-pills-start-tab">
                <div class="h4">
                    С чего начать
                </div>
                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>


            <div class="tab-pane fade" id="v-pills-main" role="tabpanel" aria-labelledby="v-pills-main-tab">
                <div class="h4">Главная</div>
                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>





            <div class="tab-pane fade" id="v-pills-tasks" role="tabpanel" aria-labelledby="v-pills-tasks-tab">
                <div class="h4">Задачи</div>
                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>




            <div class="tab-pane fade" id="v-pills-crm" role="tabpanel" aria-labelledby="v-pills-crm-tab">
                <div class="h4">CRM</div>
                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>

            <div class="tab-pane fade" id="v-pills-work" role="tabpanel" aria-labelledby="v-pills-work-tab">
                <div class="h4">Дела</div>


                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>

            <div class="tab-pane fade" id="v-pills-services" role="tabpanel" aria-labelledby="v-pills-services-tab">
                <div class="h4">Сервисы</div>

                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>

            <div class="tab-pane fade" id="v-pills-company" role="tabpanel" aria-labelledby="v-pills-company-tab">
                <div class="h4">Компания</div>

                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>


            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <div class="h4">Настройки</div>

                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>

            <div class="tab-pane fade" id="v-pills-tarif" role="tabpanel" aria-labelledby="v-pills-tarif-tab">
                <div class="h4">Тарифы</div>

                Рыбатекст используется дизайнерами, проектировщиками и фронтендерами, когда нужно быстро заполнить макеты или прототипы содержимым. Это тестовый контент, который не должен нести никакого смысла, лишь показать наличие самого текста или продемонстрировать типографику в деле.
            </div>

        </div>
    </div>
</div>