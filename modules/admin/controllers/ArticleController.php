<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\Article;
use app\modules\admin\models\ArticleSearch;
use app\modules\admin\models\Category;
use app\modules\admin\models\Tag;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ArticleController реализует действия CRUD для модели статьи. 
 */
class ArticleController extends AppAdminController
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
     * Перечисляет все модели статьи.
     * @return mixed
     */
    public function actionIndex() // Главная страница
    {
        $this->setMeta('Публикации'); // Установить заголовок

        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Отображает модель одной статьи.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionView($id) // Просмотр статей
    {
        $model = $this->findModel($id);                          // Получить статью
        $this->setMeta('Просмотр публикации: ' . $model->title); // Установить заголовок
        $category = Category::findOne($model->category_id);      // Получение категории статьи
        
        return $this->render('view', compact('model', 'category'));
    }

    /**
     * Создает новую модель статьи.
     * Если создание успешно, браузер будет перенаправлен на страницу 'view'. 
     * @return mixed
     */
    public function actionCreate() // Добавление статьи
    {
        $this->setMeta('Новая публикация'); // Установить заголовок
        $model = new Article();             // Пулучить модель статьи

        if ($model->load(Yii::$app->request->post()) && $model->save()) { // Если модель получена и сохранена

            $model->saveCategory(Yii::$app->request->post('category'));                            // Сохранение значения полученой категории
            Yii::$app->session->setFlash('success', 'Публикация "' . $model->title . '" создана'); // Созданение сесионого сообщения
            
            return $this->redirect(['view', 'id' => $model->id]); // Редирект на страницу просмотра
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate($id) // Изменение статьи
    {
        $model = $this->findModel($id);                      // Получить статью
        $this->setMeta('Изменить статью: ' . $model->title); // Установить заголовок

        if ($model->load(Yii::$app->request->post()) && $model->save(true, ['title', 'description', 'content', 'image'])) { // Если модель получена и сохранена

            $this->imageProcessing($model);   // Обновить изображение
            $this->galleryProcessing($model); // Обновить галерею
            Yii::$app->session->setFlash('success', 'Публикация "' . $model->title . '" Изменена'); // Созданение сесионого сообщения
            
            return $this->redirect(['view', 'id' => $model->id]); // Редирект на страницу просмотра
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete($id) // Удаление статьи
    {
        Yii::$app->session->setFlash('warning', 'Статья "' . $this->findModel($id)->title . '" удалена'); // Созданение сесионого сообщения
        $this->findModel($id)->delete(); // Удалить статью

        return $this->redirect(['index']); // Редирект на главную страницу
    }

    public function actionSetCategory($id) // Получить категорию
    {
        $article = $this->findModel($id); // нахождение категории по id статьи

        $selectidCategory = $article->category->id; // id текущей категорри

        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title'); // Список категорий

        if (Yii::$app->request->isPost) { // Если форма отправлена
            $category = Yii::$app->request->article('category'); // Запись значения полученой категории

            if ($article->saveCategory($category)) { // Если сохранение категории прошло успешно
                return $this->redirect(['view', 'id' => $article->id]); // Редирект на страницу просмотра
            }
        }

        return $this->render('category', compact('article', 'selectidCategory', 'categories'));
    }

    public function actionSetTags($id) // установить теги
    {
        $article      = $this->findModel($id);                               // Получение статьи по $id
        $selectedTags = $article->getSelectedTags();                         // Получение списка тегов
        $tags         = ArrayHelper::map(Tag::find()->all(), 'id', 'title'); // Получение тегов статьи

        if (Yii::$app->request->isPost) {
            $tags = Yii::$app->request->post('tags'); // Полючение всех значений из инпута
            $article->saveTags($tags); // Сохранение тегов
            return $this->redirect(['view', 'id' => $article->id]); // Редирект на страницу просмотра
        }

        return $this->render('tags', compact('article', 'selectedTags', 'tags'));
    }
    /* --- /Action --- */

    protected function findModel($id) // Получить модель
    {
        if (($model = Article::findOne($id)) !== null) { // Если модель существует
            return $model; // Вернуть модель
        }

        throw new NotFoundHttpException('Запрашиваемая публикация не существует!'); // Перейти на страницу ошибки и вывести сообщение
    }

    private function imageProcessing($model)
    {
        $model->image = UploadedFile::getInstance($model, 'image'); // Поместить значение картиники в переменную
        if ($model->image) { // Если есть изображение в модели
            $model->upload(); // Обновить изображение
        }
        unset($model->image); // Удалить изображение
    }

    private function galleryProcessing($model)
    {
        $model->gallery = UploadedFile::getInstances($model, 'gallery'); // Поместить значение картиники в переменную
        $model->uploadGallery(); // Обновить изображения
    }
}
