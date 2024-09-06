<?php

use app\models\CrmGetTasks;
use app\models\Settings;

$this->title = Settings::getPageTitle('CRM');

$js = <<< ZZZZZ
(function ($) {
    $('.task-sort-all').hide();

    $(document).on("click", ".task-sort", function () {
        var sorted_tr = $('.sorted-data');
        
        $('.task-sort-all').show();
        $('.task-sort').hide();
        
        $.each(sorted_tr, function(propName, propVal) {
            cr_deadline = $(propVal).find('.deadline').text();
            cr_day = $('.cr-day').val();

            if (cr_deadline == cr_day){
                $(propVal).show();
            } else {
                $(propVal).hide();
            }
        });
    });
    
    $(document).on("click", ".task-sort-all", function () {
        var sorted_tr = $('.sorted-data');
        
        $('.task-sort-all').hide();
        $('.task-sort').show();
        
        $.each(sorted_tr, function(propName, propVal) {
            $(sorted_tr).show();
        });
    });
    
    $(document).on("change", ".change-status", function () {
        var new_status = $(this).val();
        var id = $(this).parent().parent().data('id');
        $(this).parent().parent().data('status', new_status)
        
        $.get("index.php?r=crm/ajax-change-status", {new_status, id}, function (res) {
            console.log(res);
            refreshColors();
        });
    });
    
    function refreshColors(){
        var sorted_tr = $('.sorted-data');

        $.each(sorted_tr, function(propName, propVal) {
            var status = $(propVal).data('status');
            
            if (status == 2){
                $(propVal).css('background-color', '#fcea90');
            }
            if (status == 3){
                $(propVal).css('background-color', '#90fc90');
            }
            if (status == 5){
                $(propVal).css('background-color', '#fb8989');
            }
        });
    }
    
    refreshColors();
    
//    $(document).on("click", ".get-client-data", function() {
//        var clientid = $(this).data('id');
//        console.log(clientid);
//            
//        $.get("index.php?r=clients/get-client-info", {clientid}, function(res) {
//            $('.rm-client-info').html(res);
//        });
//    });

})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>
    <input type="hidden" class="cr-day" value="<?=date('d.m.Y')?>">
    <style>
        table {
            width: 100%;
        }

        td {
            border: 1px solid #d9d9d9;
            padding: 3px 5px;
        }

        .table-header {
            font-weight: 600;
        }

        .margin-v-30 {
            margin: 30px -15px;
        }
        .get-client-data{
            cursor: pointer;
        }
    </style>
    <div class="index-window">
        <div class="index-window-panel">
            <span class="index-window-panel-title text-gradient-light-red">CRM</span>
        </div>
        <div id="right">
            <div class="row">
                <div class="col-md-12">
                    <a 
                        href="#!"
                        class="btn btn-success" 
                        data-bs-toggle="modal" 
                        data-bs-target="#clientsAdd"
                        data-bs-backdrop="static" 
                        data-bs-keyboard="false" 
                        id="add_clients" 
                        style="color: white"
                    >
                        Добавить
                    </a>

                    <!--                <a href="index.php?r=crm/add">-->
                    <!--                    <button class="btn btn-success">Добавить</button>-->
                    <!--                </a>-->

                    <!--                <button class="btn btn-success task-sort">Показать на сегодня</button>-->
                    <!--                <button class="btn btn-success task-sort-all">Все задачи</button>-->

                    <br><br>

                    <style>
                        .modal-dialog {
                            max-width: 855px;
                        }

                        .crm-flex {
                            display: flex;
                            width: 100%;
                            align-items: stretch;
                            justify-content: space-between;
                            align-content: flex-start;
                            flex-wrap: nowrap;
                            flex-direction: row;
                        }

                        .crm-col {
                            border-radius: 15px;
                            border: 1px solid #efefef;
                            text-align: center;
                            width: calc(100% / 8 + 20px); /* min- */
                            min-height: 50vh;
                            padding: 10px;
                            margin: 0 3px;
                        }

                        .crm-task-title {
                            border-radius: 15px;
                            padding: 9px;
                            margin-bottom: 25px;
                        }

                        .crm-task {
                            border-radius: 15px;
                            padding: 9px;
                            margin-bottom: 15px;
                            border: 1px solid #d5d5d5;
                        }


                        .bg-1 {
                            background-color: #c6f8f8;
                        }

                        .bg-2 {
                            background-color: #bcd7ec;
                        }

                        .bg-3 {
                            background-color: #c5b9e0;
                        }

                        .bg-4 {
                            background-color: #bb9fff;
                        }

                        .bg-5 {
                            background-color: #f3f2ca;
                        }

                        .bg-6 {
                            background-color: #c6edc8;
                        }

                        .bg-7 {
                            background-color: #efa9a9;
                        }
                    </style>
                    <div style="width: 100%;">
                        <div class="crm-flex">
                            <div class="crm-col">
                                <div class="crm-task-title bg-1">Новое обращение</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(1);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 1,
                                    ]);
                                }
                                ?>
                            </div>

                            <div class="crm-col">
                                <div class="crm-task-title bg-2">Запрос документов</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(2);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 2,
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="crm-col">
                                <div class="crm-task-title bg-3">Встреча</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(3);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 3,
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="crm-col">
                                <div class="crm-task-title bg-4">Консультация</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(4);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 4,
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="crm-col">
                                <div class="crm-task-title bg-5">Не целевой лид</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(5);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 5,
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="crm-col">
                                <div class="crm-task-title bg-6">Договор подписан</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(6);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 6,
                                    ]);
                                }
                                ?>
                            </div>
                            <div class="crm-col">
                                <div class="crm-task-title bg-7">Сделка сорвалась</div>
                                <?php
                                $crm_tasks = CrmGetTasks::byStatus(7);

                                foreach ($crm_tasks as $crm_task) {
                                    echo $this->render('_taskCard', [
                                        'task'  => $crm_task,
                                        'color' => 7,
                                    ]);
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div style="margin-bottom: 100px"></div>

                    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" style="display: none">
                        <thead>
                        <tr>
                            <th>ЛИД</th>
                            <th>Статус</th>
                            <th>Дата обращения</th>
                            <th>Ответственный</th>
                            <th>Комментарий</th>
                            <!--                        <th>Задача</th>-->
                            <!--                        <th>Завершить к</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $data = \app\models\db\Crm::find()
                            ->asArray()
                            ->orderBy(['deadline' => SORT_ASC])
                            ->all(); // ->where(['user_id' => Yii::$app->user->id])

                        foreach ($data as $data_pos) {
                            ?>
                            <tr class="sorted-data" data-id="<?=$data_pos['id']?>"
                                data-status="<?=$data_pos['status']?>">
                                <td><?=$data_pos['client_str']?></td>

                                <td>
                                    <select class="form-control change-status">
                                        <?php
                                        $statuses = [
                                            '1' => 'Новый',
                                            '2' => 'В работе',
                                            '3' => 'Подписание договора',
                                            '4' => 'Переговоры',
                                            '5' => 'Завершен',
                                        ];

                                        foreach ($statuses as $status_id => $status) {
                                            echo "<option value='{$status_id}'";
                                            if ($data_pos['status'] == $status_id) {
                                                echo " selected ";
                                            }
                                            echo ">{$status}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>

                                <td><?=date('d.m.Y', $data_pos['datetime'])?></td>
                                <td><?=\app\models\User::getNameById($data_pos['worker'])?></td>
                                <td><?=mb_substr($data_pos['comment'], 0, 50)?></td>
                                <!--                            <td>--><? //=$data_pos['task']?><!--</td>-->
                                <!--                            <td class="deadline">-->
                                <? //=date('d.m.Y', $data_pos['deadline'])?><!--</td>-->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php echo $this->render('../clients/_add'); ?>

<?php /* модалка редактирования */ ?>
<div class="offcanvas offcanvas-end opacity box-edit box-client row" data-bs-backdrop="false" tabindex="-1"
     id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="rm-client-info"></div>
</div>
