<?php

namespace app\controllers;

use app\modules\admin\models\Article;
use app\modules\admin\models\Tag;
use app\modules\admin\models\Category;
use app\modules\admin\models\ArticleTag;

class BlogController extends AppController
{
    public function actionClassic()
    {
        $data = Article::getAll(5);

        return $this->render('classic', [
            'articles'   => $data['articles'],
            'pagination' => $data['pagination'],
        ]);
    }

    public function actionPost($id)
    {
        $article = Article::findOne($id); // Получение поста по id
        $tags    = Tag::findAll(['id' => ArticleTag::tagListId($id)]); // Запрос в таблицу tag для получения записей

        return $this->render('post', compact('article', 'tags'));
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
}
