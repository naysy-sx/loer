<?php

use app\models\db\UploadedFiles;
use app\models\logical\ImageIcons;

foreach ($folders as $folder) { ?>
    <h2 class="accordion-header" id="heading<?=$folder['id']?>">
        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse<?=$folder['id']?>" aria-expanded="true"
                aria-controls="collapse<?=$folder['id']?>">
            <i class="fa fa-folder" aria-hidden="true"></i> &nbsp; <?=$folder['name']?>
        </button>
    </h2>

    <div id="collapse<?=$folder['id']?>" class="accordion-collapse collapse" aria-labelledby="heading<?=$folder['id']?>"
         data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="offcanvas-body-scroll">
                <?php
                $files_in_folder = UploadedFiles::find()
                    ->where(['folder_id' => $folder['id']])
                    ->andWhere(['user_id' => Yii::$app->user->id])
                    ->asArray()
                    ->all();

                $files_counter = 0;

                foreach ($files_in_folder as $file){
                    echo "<a href='{$file['path']}' download='{$file['filename']}' target='_blank'>" . ImageIcons::getIcon($file['filename']) . ' ' .$file['filename'] . '</a><br>';
                    $files_counter++;
                }

                if ($files_counter == 0){
                    echo 'Пусто =(<br>';
                }
                ?>
                <div class="ajax-uploaded-files"></div>
            </div>

            <div class="upload-file" data-folder="<?=$folder['id']?>">
                <hr>
                <input type="file" class="form-control file-input" style="height: 38px;"><br>
                <div style="text-align: right">
                    <button class="btn btn-success load-file" data-id="<?=$folder['id']?>">
                        Загрузить
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
