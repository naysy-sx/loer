<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\db\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clients';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Clients', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'user_id',
            'family',
            'first_name',
            //'middle_name',
            //'avatar',
            //'pasport_serial',
            //'pasport_number',
            //'category_id',
            //'proc_status',
            //'inn',
            //'ogrn',
            //'kpp',
            //'jur_index',
            //'jur_address',
            //'fact_index',
            //'fact_address',
            //'email:email',
            //'phone',
            //'created_at',
            //'status',
            //'comment:ntext',
            //'status_position',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
