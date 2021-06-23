<?php

namespace app\models;

use yii\base\Model;
use Yii;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'string', 'length' => [3,250]]
        ];
    }

    public function attributeLabels()
    {
        return [
            'comment' => '',
        ];
    }

    public function saveComment(int $article_id)
    {
        $comment             = new Comment;
        $comment->text       = $this->comment;
        $comment->user_id    = Yii::$app->user->id;
        $comment->article_id = $article_id; // ! Не проходит валидацию
        $comment->status     = 1;
        $comment->date       = date('Y-m-d G:i:s');
        return $comment->save(false); // ! Валидация отключена
    }
}