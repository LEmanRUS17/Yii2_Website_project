<?php

namespace app\modules\admin\models;

use app\models\Comment;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;


/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property file|null $image
 * @property int|null $viewed
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $category_id
 *
 * @property Comment[] $comments
 * @property ArticleTag[] $articleTags
 */
class Article extends \yii\db\ActiveRecord
{
    public $image;   // Изображение
    public $gallery; // Массив изображений
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title',  'description', 'content'], 'required'],                    // Заголовок, описание, содержание | Обязателен
            [['title',  'description', 'content'], 'string'],                      // Заголовок, описание, содержание | Строка
            ['title', 'string', 'max' => 255],                                     // Заголовок                       | Максимальное количество символов: 255
            ['date',  'date', 'format' => 'php: Y-m-d G:i:s'],                     // Дата                            | Дата, формат: Год-месяц-день час:минута
            ['date',  'default', 'value' => date('Y-m-d G:i:s')],                  // Дата                            | Значение по умолчанию: текущая дата
            ['user_id', 'integer'],                                                // Автор                           | Входное значение типа "integer"
            ['user_id', 'default', 'value' => $_SESSION['__id']],                  // Автор                           | id залогиневшегося пользователя                           
            ['category_id', 'default', 'value' => 1],                              // Категория                       | Значение по умолчанию "1"
            ['status', 'default', 'value' => 1],                                   // Статус                          | Значение по умолчанию "1"
            ['viewed', 'default', 'value' => 0],                                   // Просмотры                       | Значение по умолчанию "0"
            
            ['image', 'file', 'extensions' => 'png, jpg, jpeg'],                   // Изображение                     | Файл формата png, jpg
            ['gallery', 'file','extensions' => 'png, jpg, jpeg', 'maxFiles' => 9], // Изображения                     | Файлы формата png, jpg. Максимальное количество 9
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID Статьи',
            'title'       => 'Наименование',
            'description' => 'Описание',
            'content'     => 'Содержимое',
            'date'        => 'Время публикации',
            'viewed'      => 'Кол-во просмотров',
            'user_id'     => 'Автор',
            'status'      => 'Статус',
            'category_id' => 'Категория',
            'image'       => 'Титульное изображение',
            'gallery'     => 'Галерея изображений',
        ];
    }

    /* --- Category --- */
    public function getCategory() // Создание связи с таблицей category
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']); // Создание связи
    }

    public function saveCategory($category_id) // Сохранить категорию
    {
        $category = Category::findOne($category_id); // получение категории
        if($category != null) { // Если категория не равна null
            $this->link('category', $category); // Передача связи
            return true;
        }
    }
    /* --- /Category ---*/
    
    /* --- Coment --- */
    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments() // Создание связи с таблицей comment
    {
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }
    
    public function getArticleComment()
    {
        return $this->getComments()->where(['status' => 1])->all();
    }
    /* --- /Coment --- */

    /* --- Tag --- */
    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery 
     */
    public function getArticleTags() // Создание связи с таблицей article_tag
    {
        return $this->hasMany(ArticleTag::class, ['article_id' => 'id']);
    }

    public function getTags() // Создание связи таблицы Tag
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('article_tag', ['article_id' => 'id']);
    }

    public function getSelectedTags() // Получить список тегов
    {
        $selectedIds = $this->getTags()
            ->select('id') // Получить все теги связанные с id поста
            ->asArray()    // Получить в виде массива
            ->all();       // Выбрать все

        return ArrayHelper::getColumn($selectedIds, 'id'); // Вернуть список выбранных тегов с их id
    } 
    
    public function saveTags($tags) // Сохранение тегов
    {
        if (is_array($tags)) {
            $this->clearCurrentTags(); // Удаление старых тегов

            foreach ($tags as $tag_id) {
                $tag = Tag::findOne($tag_id);
                $this->link('tags', $tag);
            }
        }
    }

    public function clearCurrentTags() // Удаление всех тегов
    {
        ArticleTag::deleteAll(['article_id' => $this->id]);
    }
    
    /* --- /Tag --- */

    /* --- image --- */
    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->image->baseName . '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path); // Удаление картинки
            return true;
        } else {
            return false;
        }
    }

    public function uploadGallery(){
        if ($this->validate()) {
            foreach($this->gallery as $file) {
                $path = 'upload/store/' . $file->baseName . '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                unlink($path); // Удаление картинки
            }
            return true;
        } else {
            return false;
        }
    }
    /* --- /image --- */

    public static function getPopular($limit = 3) // Получение популярных статей
    {
        return Article::find()->orderBy('viewed desc')->limit($limit)->all(); 
    }

    public function getDate() // Получить дату создания
    {
        return Yii::$app->formatter->asDate($this->date, 'php:d M Y');
    }

    public static function getAll($pageSize = 5) // Статичный метод для получени пагинации
    {
        // создать запрос к БД, чтобы получить все статьи
        $query      = Article::find()->orderBy('date DESC');     // Получение статей из БД
        $pagination = Article::getPagination($query, $pageSize); // Сформировать пагинацию

        return Article::ArticlesByPage($query, $pagination);
    }

    public static function getPagination($query, $pageSize = 5, $forcePageParam = false, $pageSizeParam = false) // Сформировать пагинацию
    {
        $pagination = new Pagination(['totalCount' => $query->count(), // Передача количества
            'pageSize'       => $pageSize,       // Количество элементов на странице
            'forcePageParam' => $forcePageParam, 
            'pageSizeParam'  => $pageSizeParam
        ]);

        return $pagination;
    }

    public static function ArticlesByPage($query, $pagination)  // Сформировать Массив из статей с пагинацией
    {
        // ограничить запрос с помощью разбивки на страницы и получить статьи
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit) // Указание лимита выводимых записей на странице
            ->all();

        $data['articles']   = $articles;
        $data['pagination'] = $pagination;
    
        return $data;
    }

    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function viewedCounter()
    {
        $this->viewed += 1;
        return $this->save(false);
    }
}
