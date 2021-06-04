<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\Article;
use app\modules\admin\models\Category;
use app\modules\admin\models\CategorySearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * ChartyController реализует действия CRUD для модели категории. 
 */
class CategoryController extends AppAdminController
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

    /* --- Action --- */
    /**
     * Перечисляет все модели категории.
     * @return mixed
     */
    public function actionIndex() // Главная страница
    {
        $this->setMeta('Список категорий');
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Отображает модель одной категории.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    public function actionView($id) // Просмотр статей
    {
        $model = $this->findModel($id);                 // Получение категории по id
        $this->setMeta('Категория: ' . $model->title);  // Название страницы
        return $this->render('view', compact('model'));
    }

    /**
     * Создает новую модель категории.
     * Если создание успешно, браузер будет перенаправлен на страницу 'view'. 
     * @return mixed
     */
    public function actionCreate() // Добавление статьи
    {
        $model = new Category();           // Получить модель категорий
        $this->setMeta('Новая категория'); // Название страницы

        if ($model->load(Yii::$app->request->post()) && $model->save()) { // Если модель получена и сохранена
            Yii::$app->session->setFlash('success', 'Категория "' . $model->title . '" создана'); // Сесионное сообщение
            return $this->redirect(['view', 'id' => $model->id]); // Редирект на страницу просмотра
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Обновляет существующую модель категории.
     * Если обновление успешно, браузер будет перенаправлен на страницу 'view'. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    public function actionUpdate($id) // Изменение статьи
    {
        $model = $this->findModel($id); // Получение категории по id
        $this->setMeta('Изменение категории: ' . $model->title); // Название страницы
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Категория "' . $model->title . '" изменена'); // Сесионное сообщение
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Удаляет существующую модель категории.
     * Если удаление успешно, браузер будет перенаправлен на страницу 'index'. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    public function actionDelete($id) // Удаление статьи
    {
        Yii::$app->session->setFlash('warning', 'Категория "' . $this->findModel($id)->title . '" удалена'); // Сесионное сообщение
        $this->findModel($id)->delete();        
        return $this->redirect(['index']);
    }
    /* --- /Action --- */

    /**
     * Находит модель категории на основе её id.
     * Если модель не найдена, будет брошена исключение 404 HTTP. 
     * @param integer $id
     * @return Category загруженная модель
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрошеная категория не существует!');
    }

    public function getArticle() // Связь с таблицей 'article'
    {
        return $this->hasMany(Article::className(), ['category_id' => 'id']);
    }
}
