<?php
use yii\helpers\Url;
use yii\helpers\Html;


$documents = [
    [
        'item' => [
            'id' => '001',
            'num' => '345345',
            'title' => 'Заявление',
            'subtitle' => 'о пересмотре дела по вновь открывшимся обстоятельствам',
            'type' => 'statement',
            'content' => 'Контент',
        ],
    ],
    [
        'item' => [
            'id' => '002',
            'num' => '12222234',
            'title' => 'Отзыв',
            'subtitle' => 'на исковое заявление',
            'type' => 'reply',
            'content' => 'Контент',
        ],
    ],
    [
        'item' => [
            'id' => '003',
            'num' => '65785',
            'title' => 'Ходатайство',
            'subtitle' => 'о перепредъявлении обвинения и дополнительном допросе обвиняемого',
            'type' => 'petition',
            'content' => 'Контент',
        ],
    ],
    [
        'item' => [
            'id' => '004',
            'num' => '55555',
            'title' => 'Аппеляционная жалоба',
            'subtitle' => 'на приговор суда',
            'type' => 'appeal',
            'content' => 'Контент',
        ],
    ],
    [
        'item' => [
            'id' => '005',
            'num' => '4784333',
            'title' => 'Возражение',
            'subtitle' => 'на экспертизу',
            'type' => 'objections',
            'content' => 'Контент',
        ],
    ],
];
?>


<details class="pdf-block">
    <summary>Тестирование генерации документов</summary>
    <ul class="pdf-block-list">
        <?php if (!empty($documents)): ?>
            <?php foreach ($documents as $document): ?>
                <?php
                if (isset($document['item'])) {
                    $item = $document['item'];
                    $id = $item['id'];
                    $num = $item['num'];
                    $title = $item['title'];
                    $subtitle = $item['subtitle'];
                    $type = $item['type'];
                    ?>
                    <li>
                        <a href="<?= Url::to([
                                'pdf-test/generate', 
                                'id' => $id, 
                                'num' => $num, 
                                'title' => $title,  
                                'subtitle' => $subtitle, 
                                'type' => $type
                            ]) ?>">
                            <?= Html::encode($title) ?> <?= Html::encode($subtitle) ?>
                        </a>
                    </li>
                    <?php
                } else {
                    echo "<li>Ошибка: элемент массива не содержит ключ 'item'.</li>";
                }
                ?>
            <?php endforeach; ?>
        <?php else: ?>
            <li>Список документов пуст.</li>
        <?php endif; ?>
    </ul>
</details>