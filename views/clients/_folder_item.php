<ul class="folder-list">
    <?php foreach ($folders as $folder) : ?>
        <li class="folder-list-item">
            <span>
                <b>🖿</b>
                <a href="" class="folder">
                    <?= Html::encode($folder->title) ?>
                </a>
            </span>
            <div>
                <a href="#" class="rename" data-id="<?= $folder->id ?>" data-type="folder">переименовать</a>
                <a href="#" class="delete" data-id="<?= $folder->id ?>" data-type="folder">удалить</a>
            </div>
        </li>
    <?php endforeach; ?>
</ul>