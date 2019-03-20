<?php

/**
 * Created by PhpStorm.
 * User: NIKITALIAN
 * Date: 20.03.2019
 * Time: 15:12
 */

use yii\web\ForbiddenHttpException;

/* @var $this \yii\web\View */

$this->title = 'Услуга под номером ID: ' . $model[0]['id'];
$this->params['breadcrumbs'][] = ['label' => 'Services', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;
if (empty($model)) {
    throw new ForbiddenHttpException('Истории нет.');
}
\yii\web\YiiAsset::register($this); ?>
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">Дата и время изменения</th>
        <th scope="col">Какое поле</th>
        <th scope="col">Старое и новое значение</th>
        <th scope="col">Кем изменён</th>
    </tr>
    </thead>
    <?php foreach ($model as $res) {
        $result = array_diff($res, array(''));
        unset($result['data_edit']);
        unset($result['id']);
        unset($result['user']);
        foreach ($result as $key => $item) { ?>
            <tbody>
            <tr>
                <td><?= $res['data_edit'] ?></td>
                <td><?= $key ?></td>
                <td><?= $item ?></td>
                <td><?= $res['user'] ?></td>
            </tr>
            </tbody>
        <?php }
    } ?>
</table>
