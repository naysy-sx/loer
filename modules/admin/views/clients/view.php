<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\db\Clients */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'company_id',
            'user_id',
            'family',
            'first_name',
            'middle_name',
            'avatar',
            'pasport_serial',
            'pasport_number',
            'category_id',
            'proc_status',
            'inn',
            'ogrn',
            'kpp',
            'jur_index',
            'jur_address',
            'fact_index',
            'fact_address',
            'email:email',
            'phone',
            'created_at',
            'status',
            'comment:ntext',
            'status_position',
        ],
    ]) ?>

</div>
