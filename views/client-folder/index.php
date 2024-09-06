<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Folders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-folders-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client Folders', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creator_id',
            'title',
            'parent_folder_id',
            'create_date',
            //'publish_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
