<?php

namespace app\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int         $id
 * @property string|null $text
 * @property int|null    $user_id
 * @property int|null    $article_id
 * @property int|null    $status
 * @property string|null $date
 *
 * @property User    $user
 * @property Article $article
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'article_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['text'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'text'       => 'Text',
            'user_id'    => 'User ID',
            'article_id' => 'Article ID',
            'status'     => 'Status',
            'date'       => 'Date',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Article]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }

    public static function numberOfComments($id) // Количество коментариев статьи
    {
        $comments = Comment::find()       // Запрос в таблицу comment
            ->select('article_id')        // Записи из столбца article_id
            ->where(['article_id' => $id, // Выбор записей значение столбца article_id которых равно id
                'status' => 1])           // Выбор записей значение столбца status которых равно 1
            ->count();                    // Получить все записи
        
        return $comments;
    }

    public function getDate() // Получить дату создания
    {
        return Yii::$app->formatter->asDate($this->date, 'php:d M Y | g:i');
    }
}
