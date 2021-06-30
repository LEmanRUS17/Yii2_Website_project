<?php

namespace app\controllers;

use Yii;
use app\models\Comment;
use app\models\CommentForm;
use app\modules\admin\models\Article;
use app\modules\admin\models\Tag;
use app\modules\admin\models\Category;
use app\modules\admin\models\ArticleTag;

class BlogController extends AppController
{
    public function actionClassic()
    {
        $data = Article::getAll(3);

        return $this->render('classic', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function actionPost($id)
    {
        $article  = Article::findOne($id);                              // Получение поста по id
        $tags     = Tag::findAll(['id' => ArticleTag::tagListId($id)]); // Запрос в таблицу tag для получения записей
        $comments = $article->getArticleComment();                      // Получение коментариев поста
        $commentForm = new CommentForm();                               // Форма для сознания коментария

        $article->viewedCounter();
        
        return $this->render('post', compact('article', 'tags', 'comments', 'commentForm'));
    }

    // http://html5up-striped.loc/home/category
    public function actionCategory($id) // Получить список статей по категориям
    {
        $data = Category::getArticleByCategory($id);
        $info = 'Список статей c категорией: ';

        return $this->render('classic', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
            'name'       => $data['name'],
            'info'       => $info,
        ]);
    }

    public function actionTag($id)
    {
        $data = ArticleTag::getTagArticle($id);
        $info = 'Список статей c тегом: ';

        return $this->render('classic', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
            'name'       => $data['name'],
            'info'       => $info,
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();
        
        if(Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            
            if($model->saveComment($id))
            {                
                return $this->redirect(['post', 'id' => $id]);
            }
        }
    }
}
