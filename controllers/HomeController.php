<?php

namespace app\controllers;

class HomeController extends AppController
{
    public function actionIndex()
    {
        $this->view->params['isHome'] = true; // "Домашняя страница"

        return $this->render('index');
    }
}