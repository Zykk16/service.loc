<?php
/**
 * Created by PhpStorm.
 * User: NIKITALIAN
 * Date: 20.03.2019
 * Time: 1:30
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{

    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // создаю роли админа и оператора
        $admin = $auth->createRole('admin');
        $operator = $auth->createRole('operator');

        // записываю их в БД
        $auth->add($admin);
        $auth->add($operator);

        // создаю разрешения
        $viewAdminPage = $auth->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Полный доступ к админ-панели';

        $updateService = $auth->createPermission('updateService');
        $updateService->description = 'Редактирование услуги';

        // записываю в БД
        $auth->add($viewAdminPage);
        $auth->add($updateService);

        //присваивание $operator к разрешению
        $auth->addChild($operator, $updateService);

        // админ наследует роль оператора
        $auth->addChild($admin, $operator);

        // Еще админ имеет собственное разрешение типа полного доступа
        $auth->addChild($admin, $viewAdminPage);

        $auth->assign($admin, 1);
//        $auth->assign($operator, 2);
    }
}