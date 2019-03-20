<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList(['1' => 'Включить', '0' => 'Выключить']); ?>

    <?= $form->field($model, 'data_duration')->widget(DatePicker::classname(), [
        'language' => 'ru',
//        'dateFormat' => 'MM/dd/yyyy',
    ]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
