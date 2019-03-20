<?php
/**
 * Created by PhpStorm.
 * User: NIKITALIAN
 * Date: 19.03.2019
 * Time: 21:58
 */

namespace backend\modules\api\controllers;

use backend\models\ServiceSearch;
use yii\rest\ActiveController;

class ApiController extends ActiveController
{
    public $modelClass = 'backend\models\Service';

    //подключил FORMAT_JSON
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    //переопределил actions
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    //добавил фильтрацию
    public function prepareDataProvider()
    {
        $searchModel = new ServiceSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}