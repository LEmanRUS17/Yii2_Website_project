<?php

namespace app\controllers;

use app\models\LoginForm;
use app\models\User;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use Yii;

class AuthController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            [
                'class' => AccessControl::className(),
                'rules' => [
                    [

                        'allow' => true,
                        //'roles' => ['user'],
                    ],
                ],
            ],
        ];
    }

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

    /**
     * Создает новую модель пользователя .
     * Если создание успешно, браузер будет перенаправлен на страницу «View».
     * @return mixed
     */
    public function actionRegistration()
    {
        $this->setMeta('Регистрация');

        $model = new User(['scenario' => User::SCENARIO_REGISTER]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) { // Если данные отправлены и прошли валидацию

            $model->password = $this->passwordHashing($model); // Запись хешированого пароля в модель

            if ($model->save(false)) { // сохранени данных в БД без валидации

                $this->imageProcessing($model); // Добавление изображения
                $this->registerRole($model);    // Регестрация роли
                Yii::$app->session->setFlash('success', 'Пользователь  "' . $model->username . '" создан'); // Сесионное сообщение

                return $this->redirect(['login']);
            }
        }

        $model->password        = null; // Очищение пароля из формы
        $model->password_repeat = null; // Очищение повторного пароля из формы

        return $this->render('registration', compact('model'));
    }


    /* --- Secondary --- */
    private function imageProcessing($model)
    {
        $model->image = UploadedFile::getInstance($model, 'image'); // Поместить значение картиники в переменную
        if ($model->image) { // Если есть изображение в модели
            $model->upload(); // Обновить изображение
        }
        unset($model->image); // Удалить изображение
    }

    private function registerRole($model)
    {
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole('user');
        $auth->assign($authorRole, $model->getId());
    }

    private function passwordHashing($model)
    {
        return Yii::$app->getSecurity()->generatePasswordHash($model->password); // Xеширование  пароля
    }
    /* --- /Secondary --- */
}