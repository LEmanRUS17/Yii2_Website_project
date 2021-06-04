<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "article_tag".
 *
 * @property int      $id
 * @property int|null $article_id
 * @property int|null $tag_id
 *
 * @property Tag     $tag
 * @property Article $article
 */
class ArticleTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_tag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'integer'],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'article_id' => 'Article ID',
            'tag_id'     => 'Tag ID',
        ];
    }

    /**
     * Gets query for [[Tag]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTag() // Связь с таблицей Tag
    {
        return $this->hasOne(Tag::class, ['id' => 'tag_id']);
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle() // Связь с таблицей Article
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    public static function tagListId($id) // Получить список id тегов поста
    {
        $article_tag = ArticleTag::find()  // Запрос в таблицу article_tag
            ->select('tag_id')             // Записи из столбца tag_id
            ->where(['article_id' => $id]) // Выбор записей значение столбца article_id которых равно id
            ->asArray()                    // Сформировать массив
            ->all();                       // Получить все записи

        // Преобразование результата $article_tag в одномернаы массив:
        foreach ($article_tag as $tag) {
            $tagList[] = $tag['tag_id'];
        }

        return $tagList;
    }

    public static function getTagName($id)
    {
        $query = Tag::findOne(['id' => $id]);

        return $query->title;
    }

    public static function getTagArticle($id)
    {
        $query = ArticleTag::find()->where(['tag_id' => $id])->all(); // Получить список статей по тегу

        // Свормировать массив id статей по тегу
        foreach($query as $article){ 
            $articles[] = $article->article_id;
        };

        $query = Article::find()->where(['id' => $articles]); // получить записи по id из массива articles

        $count = $query->count(); // Количество записей

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]); // Передача количества статей и максимального числа на странице

        // ограничить запрос с помощью разбивки на страницы и получить статьи 
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit) // Указание лимита выводимых записей на странице
            ->all();

        $data['articles']   = $articles;
        $data['pagination'] = $pagination;
        $data['name']       = ArticleTag::getTagName($id);

        return $data;
    }
}
