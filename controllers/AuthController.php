<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use Yii;

class AuthController extends AppController
{
    public function actionLogin() // Авторизация пользователя
    {
        $this->setMeta('Вход');
        
        if (!Yii::$app->user->isGuest) { // Если пользователь авторизован
            return $this->goHome(); // Направить на главную страницу
        }

        $model = new LoginForm(); // Получить метод формы
        if ($model->load(Yii::$app->request->post()) && $model->login()) { // Если загрузка данных в форму методом post и вход выполнены успешно
            return $this->goBack(); // Напрвить на предыдущую страницу
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout() // Выход из аккаунта
    {
        Yii::$app->user->logout(); // выполнить метод logout

        return $this->goHome(); // Направить на главную страницу
    }
}