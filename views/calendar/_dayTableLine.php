<?php
$js = <<< ZZZZZ
(function ($) {
  $(document).on("click", ".edit-task", function () {
    $('#edit-task-modal').modal('show');
    var id = $(this).data('id');
    
    // ресет полей
    $('.edit-task-title').val('');
    $('.edit-task-description').val('');
    $('.edit-task-date').val('');
    $('.edit-task-time').val('');
    
    $.get("index.php?r=ajax/get-data-by-task-modal", {id}, function(res) {
      var data = jQuery.parseJSON(res);
  
      // заполнение полей
      $('.edit-task-title').val(data.title);
      $('.edit-task-description').val(data.description);
      $('.edit-task-date').val(data.datetime);
      $('.edit-task-time').val(data.time);
      $('.edit-task-id').val(data.id);
      $('.client_id').val(data.client_id);
      $('.lead_id').val(data.client_id);
      
      console.log(data);
   
      $('#edit-task-modal').modal('show');
    });
  });
  
  $(document).on("click", ".edit-task-save-btn", function () {
    var id          = $('.edit-task-id').val();
    var title       = $('.edit-task-title').val();
    var description = $('.edit-task-description').val();
    var date        = $('.edit-task-date').val();
    var time        = $('.edit-task-time').val();
    var lead_id     = $('.lead_id').val();
    var client_id   = $('.client_id').val();
    
    $.get("index.php?r=ajax/save-data-by-task-modal", {id, title, description, date, time, lead_id, client_id}, function(res) {
      window.location.reload();
    });
  });
})(jQuery);
ZZZZZ;

$this->registerJs($js, yii\web\View::POS_READY);
?>

<?php
  $human_date_format = date('d.m.Y', strtotime($day));
?>

<?php
  $cr_tasks = \app\models\db\Tasks::find()
      ->where(['user_id' => Yii::$app->user->id])
      ->andWhere(['datetime_end' => $day])
      ->asArray()
      ->all();
  ?>

<?php foreach ($cr_tasks as $count => $cr_task): ?>



<!-- СТРОКА ТАБЛИЦЫ -->
  <?php
  $human_date_format = date('d.m.Y', strtotime($day));
  ?>
  <tr class="edit-task one-task <?= !$cr_task['status'] ? ($cr_task['overdue'] ? 'red ' : '') : 'task-complete'; ?>"
    data-id="<?= $cr_task['id']; ?>">
    <!-- 1 Статус -->
    <td>
      <input 
        type="checkbox" 
        class="task-checkbox"
        <?= $cr_task['status'] ? 'checked="checked"' : ''; ?>
      >
    </td>

    <!-- 2 Описание -->
    <td>
      <p><b><?= $cr_task['title']; ?></b></p>
      <?= nl2br($cr_task['description']); ?>
    </td>

    <!-- 3 Время -->
    <td>
      <?= $cr_task['time'] != '00:00' ? $cr_task['time'] : ''; ?>
    </td>

    <!-- 4 Дело -->
    <td>
      <?php
      if ($cr_task['client_id']){
          \app\models\db\Clients::getNameById($cr_task['client_id']);
      }
      ?>
    </td>

    <!-- 5 Ответственный-->
    <td></td>

    <!-- 6 Постановщик -->
    <td>
      <?= Yii::$app->user->identity->username; ?> 
    </td>
  </tr>

<?php endforeach; ?>

<div class="modal fade" id="edit-task-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирование задачи</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Название задачи:</label>
                            <input type="hidden" class="form-control edit-task-id">
                            <input type="text" class="form-control edit-task-title">
                        </div>

                        <div class="form-group">
                            <label>Описание задачи:</label>
                            <textarea class="form-control edit-task-description" rows="4"></textarea>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label>Дата завершения:</label>
                                <input type="date" class="form-control edit-task-date" value="2024-06-07">
                            </div>
                            <div class="form-group col">
                                <label>Время:</label>
                                <input type="time" class="form-control edit-task-time">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Ответственный:</label>
                            <select class="form-control edit-task-user">
                                <option value="1">(себе)</option>
                            </select>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col">
                                <label>Клиент:</label>
                                <select class='form-control client_id'>
                                    <option value="0">Выберите</option>
                                    <?php
                                    $clients =
                                        \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])
                                            ->where(['status_position' => 6])
                                            ->andWhere(['user_id' => Yii::$app->user->id])
                                            ->asArray()
                                            ->all();

                                    foreach ($clients as $client) {
                                        echo "<option value='{$client['id']}'>{$client['family']} {$client['first_name']} {$client['middle_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label>Лид:</label>
                                <select class='form-control lead_id'>
                                    <option value="0">Выберите</option>
                                    <?php
                                    $clients =
                                        \app\models\db\Clients::find()->where(['user_id' => Yii::$app->user->id])
                                            ->where([
                                                '!=',
                                                'status_position',
                                                6,
                                            ])
                                            ->andWhere(['user_id' => Yii::$app->user->id])
                                            ->asArray()
                                            ->all();

                                    foreach ($clients as $client) {
                                        echo "<option value='{$client['id']}'>{$client['family']} {$client['first_name']} {$client['middle_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer pb-0" style="text-align: center; display: block;">
                            <button class="btn btn-success edit-task-save-btn">Сохранить</button>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload()">
                                Отменить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


