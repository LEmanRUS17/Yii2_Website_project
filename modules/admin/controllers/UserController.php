<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\User;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\UserSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * Usercontroller реализует действия CRUD для модели пользователя.
 */
class UserController extends AppAdminController
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
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Перечисляет все модели пользователей.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMeta('Список пользователей');
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Отображает одну модель пользователя. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->setMeta('Профиль пользователя: ' . $model->username);

        return $this->render('view', compact('model'));
    }

    /**
     * Создает новую модель пользователя .
     * Если создание успешно, браузер будет перенаправлен на страницу «View».
     * @return mixed
     */
    public function actionCreate()
    {
        $this->setMeta('Создание пользователя');

        $model = new User(['scenario' => User::SCENARIO_REGISTER]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) { // Если данные отправлены и прошли валидацию
            
            $model->password = $this->passwordHashing($model); // Запись хешированого пароля в модель

            if ($model->save(false)) { // сохранени данных в БД без валидации

                $this->imageProcessing($model); // Добавление изображения
                $this->registerRole($model);    // Регестрация роли
                Yii::$app->session->setFlash('success', 'Пользователь  "' . $model->username . '" создан'); // Сесионное сообщение
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $model->password        = null; // Очищение пароля из формы
        $model->password_repeat = null; // Очищение повторного пароля из формы

        return $this->render('create', compact('model'));
    }

    /**
     * Обновление существующей модели пользователя.
     * Если обновление успешно, браузер будет перенаправлен на страницу «View».
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    public function actionUpdate($id) // Редактирование пользователя
    {
        $model = $this->findModel($id);
        $model->scenario        = $model::SCENARIO_UPDATE; // Сценарий валидации
        $model->currentEmail    = $model->email;           // Записать в модель текущий email
        $model->currentUsername = $model->username;        // Записать в модель текущее имя пользователя

        $this->setMeta('Редактирование пользователя: ' . $model->username);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Пользователь "' . $model->username . '" изменен'); // Сесионное сообщение
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Удаляет существующую модель пользователя. 
     * Если удаление успешно, браузер будет перенаправлен на страницу 'index'. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash('warning', 'Пользователь "' . $this->findModel($id)->username . '" удален'); // Сесионное сообщение
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Находит модель пользователя на основе его основного значения id. 
     * Если модель не найдена, будет брошена исключение 404 HTTP. 
     * @param integer $id
     * @return User загруженная модель 
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) { // Если модель пользователя найдена
            return $model;
        }

        throw new NotFoundHttpException('Такой записи не существует.'); // Если модель пользователя не найдена
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
