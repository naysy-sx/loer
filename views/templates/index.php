<?php

use app\models\db\TemplatesDocs;

$docs   = TemplatesDocs::find()->asArray()->all();

if (isset($data) && is_object($data)){
    foreach ($docs as $doc) {
        $id             = ucfirst($doc['id']);
        $type           = ucfirst($doc['type']);
        $title          = ucfirst($doc['title']);
        $pravo          = ucfirst($doc['pravo']);
        $translit_pravo = ucfirst($doc['translit_pravo']);
        $content        = ucfirst($doc['content']);
        $link           = "index.php?r=pdf-test%2Fgenerate&id={$id}&client_id={$data->id}&sud_id=111";
        echo "<li class='pdf-block-item'><a class='pdf-block-link' href='{$link}'>{$type} {$title}</a></li>";
    }
}
