<?php

namespace app\modules\admin\models;

use yii\data\Pagination;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],  // Наименование | Строка длиной не более 255
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'title' => 'Наименование',
        ];
    }

    public function getArticlesCount() // Получение количества статей в категории
    {
        return $this->getArticles()->count();
    }

    public static function getAll() // Получение списка категорий
    {
        return Category::find()->all(); 
    }

    public static function getCategory($id)
    {
        $category = Category::find()->where(['id' => $id])->one();

        return $category->title;
    }

    public function getArticles() // Связь с таблицей Articles
    {
        return $this->hasMany(Article::class, ['category_id' => 'id']); // "Связь один к одному", связь category_id таблицы Article и id таблицы Category 
    }

    public static function getArticleByCategory($id)
    {               
        // Формирование пагинации:
        // создать запрос к БД, чтобы получить все статьи
        $query = Article::find()->where(['category_id' => $id]); // Получение статей из БД

        // получить общее количество статей (но пока не получать данные о статьях) 
        $count = $query->count(); // Передача количества

        // создать объект разбивки на страницы с общим количеством 
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]); // Передача количества статей и максимального числа на странице

        // ограничить запрос с помощью разбивки на страницы и получить статьи 
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit) // Указание лимита выводимых записей на странице
            ->all();

        $data['articles']   = $articles;
        $data['pagination'] = $pagination;
        $data['name']       = Category::getCategory($id);

        return $data;
    }
}
