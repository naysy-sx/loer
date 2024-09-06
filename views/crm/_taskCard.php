<div class="crm-task get-client-data" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-id="<?=$task['id'] ?>" style="position: relative; padding-top: 2rem;">
    <small class="badge badge-light" style="position: absolute; top: 0.3rem; left: 0.3rem;"> 
    <?php 
        if($task['category_id'] == 1){
            echo 'Физическое лицо ';
        }
        if($task['category_id'] == 2){
            echo 'Юридическое лицо ';
        }
        if($task['category_id'] == 3){
            echo 'ИП ';
        }
    ?>
    </small>
    <p class="crm-task-user"><?=$task['comment']?></p>
    <small style="color: lightslategrey">Создано: <?=date('d.m.Y', $task['created_at'])?></small><br>
</div>