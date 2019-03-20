<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */

$this->title = 'Обновить услугу: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Услуга под номером ID: ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <p><?= Html::a('Просмотреть историю изменений', ['history', 'id' => $model->id], ['class' => 'btn btn-primary']) ?></p>
</div>
