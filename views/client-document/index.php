<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Client Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-documents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Client Documents', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'creator_id',
            'folder_id',
            'title',
            'type',
            //'pravo',
            //'create_date',
            //'publish_status',
            //'content:ntext',
            //'last_modified_date',
            //'last_modified_by',
            //'tags',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
