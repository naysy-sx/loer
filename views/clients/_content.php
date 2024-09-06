<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<ul class="docs-area">
    <li class="docs-area-section">
        <ul class="docs-list">
            <?php foreach ($folders as $folder) : ?>
                <li class="docs-list-item">
                    <b class=""></b>
                    <a href="<?= Url::to(['docs/view', 'id' => $folder->id]) ?>" class="folder">
                        <span><?= Html::encode($folder->title) ?></span>
                    </a>
                    <?= Html::a('переименовать', ['docs/rename', 'id' => $folder->id], ['class' => 'rename-link']) ?>
                    <?= Html::a('удалить', ['docs/delete', 'id' => $folder->id], ['class' => 'delete-link']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
    <li class="docs-area-section">
        <ul class="docs-list">
            <?php foreach ($documents as $document) : ?>
                <li class="docs-list-item">
                    <b class=""></b>
                    <a href="<?= Url::to(['docs/view', 'id' => $document->id]) ?>" class="document">
                        <span><?= Html::encode($document->title) ?></span>
                    </a>
                    <?= Html::a('изменить', ['docs/update', 'id' => $document->id], ['class' => 'update-link']) ?>
                    <?= Html::a('переименовать', ['docs/rename', 'id' => $document->id], ['class' => 'rename-link']) ?>
                    <?= Html::a('удалить', ['docs/delete', 'id' => $document->id], ['class' => 'delete-link']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </li>
</ul>