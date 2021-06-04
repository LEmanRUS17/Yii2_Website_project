<?php

//----- Контроллер от которого наследуют другие контроллеры -----//

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;


class AppAdminController extends Controller
{
    protected function setMeta($title = null) // Установка значения тега <title>
    {
        $this->view->title = $title;
    }

    protected function validationCheck($model) // Проверка валидации
    {
        if ($model->load(Yii::$app->request->post()) && !$model->validate()) {
            foreach ($model->getErrors() as $key => $value) {
                echo $key . ': ' . $value[0];
            }
            die;
        }
    }
}
