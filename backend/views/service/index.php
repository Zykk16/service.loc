<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    if (Yii::$app->user->can('admin')) { ?>
        <p>
            <?= Html::a('Создать услугу', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } else { ?>
        <p>
            <?= Html::button('Создать услугу может только админ', ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'code',
            'price',
            'desc:ntext',
            'status',
            'data_duration',
            'city',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {history}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<button class="btn btn-sm btn-outline-secondary" style="margin-bottom: 5px;width: 100%;">Открыть</button><br>', $url);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<button class="btn btn-sm btn-outline-secondary" style="margin-bottom: 5px;width: 100%;">Изменить</button><br>', $url);
                    },
                    'history' => function ($url, $model) {
                        return Html::a('<button class="btn btn-sm btn-outline-secondary" style="margin-bottom: 5px;width: 100%;">История</button><br>', $url);
                    },

                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
