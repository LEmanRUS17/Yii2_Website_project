<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createArticle" (Добавение статьи)
        $createArticle = $auth->createPermission('createArticle');
        $createArticle->description = 'Create a Article';
        $auth->add($createArticle);

        // добавляем разрешение "updateArticle" (Изменение статьи)
        $updateArticle = $auth->createPermission('updateArticle');
        $updateArticle->description = 'Update Article';
        $auth->add($updateArticle);

        // добавляем разрешение "accessAdminPanel"
        $accessAdminPanel = $auth->createPermission('accessAdminPanel');
        $accessAdminPanel->description = 'Access to admin panel';
        $auth->add($accessAdminPanel);

        // добавляем роль "user" и даём роли разрешение "createArticle"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createArticle);

        // добавляем роль "admin" и даём роли разрешение "updateArticle" и "accessAdminPanel"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateArticle);
        $auth->addChild($admin, $accessAdminPanel);
        $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }
}
