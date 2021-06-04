<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Tag;
use app\modules\admin\models\TagSearch;
use app\modules\admin\controllers\AppAdminController;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagController реализует действия CRUD для модели тегов. 
 */
class TagController extends AppAdminController
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
     * Перечисляет все модели тегов.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->setMeta('Список тегов');

        $searchModel = new TagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    /**
     * Отображает одну модель тега. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->setMeta('Тег: ' . $model->title);
        return $this->render('view', compact('model'));
    }

    /**
     * Создает новую модель тега.
     * Если создание успешно, браузер будет перенаправлен на страницу 'view'. 
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tag();
        $this->setMeta('Создание тега');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Тег "' . $model->title . '" создан'); // Сесионное сообщение
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', compact('model'));
    }

    /**
     * Обновляет существующую модель тега. 
     * Если обновление успешно, браузер будет перенаправлен на страницу 'view'. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->setMeta('Изменение тега: ' . $model->title);
        if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            Yii::$app->session->setFlash('success', 'Тег сохранен'); // Сесионное сообщение
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', compact('model'));
    }

    /**
     * Удаляет существующую модель тега.
     * Если удаление успешно, браузер будет перенаправлен на страницу 'index'. 
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException Если модель не может быть найдена 
     */
    public function actionDelete($id)
    {
        Yii::$app->session->setFlash('warning', 'Тег "' . $this->findModel($id)->title . '" удален'); // Сесионное сообщение

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Находит модель тега на основе его id. 
     * Если модель не найдена, будет брошена исключение 404 HTTP. 
     * @param integer $id
     * @return Tag the loaded model
     * @throws NotFoundHttpException Если модель не может быть найдена
     */
    protected function findModel($id)
    {
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запрашиваемый тег не существует!');
    }
}