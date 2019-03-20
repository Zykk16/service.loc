<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title = 'Услуга под номером ID: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('История изменений', ['history', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        if (Yii::$app->user->can('admin')) {
            echo Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        } else {
            echo Html::button('Нельзя оператору удалять', ['class' => 'btn btn-danger']);
        } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'price',
            'desc:ntext',
            'status',
            'data_duration',
            'city',
        ],
    ]) ?>

</div>
