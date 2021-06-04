<?php

use app\modules\admin\models\Category;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor; // Использование визуального редактора
use mihaildev\elfinder\ElFinder; // Использование файлового менеджера

mihaildev\elfinder\Assets::noConflict($this);

?>

<div class="article-form">


    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?//= $form->field($model, 'content')->textarea(['rows' => 10]) ?>

    <?php
        /*echo $form->field($model, 'content')->widget(CKEditor::class, [
            'editorOptions' => [
                'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'inline' => false, //по умолчанию false
            ],
        ]);*/
    ?>

    <?=
        $form->field($model, 'content')->widget(CKEditor::class, [
            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => 'some/sub/path'],[/* Some CKEditor Options */]),
        ]);
    ?>

    <?= $form->field($model, 'image')->fileInput() ?>
    <!-- Поле для загрузки картинки -->

    <?= $form->field($model, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <!-- Поле для загрузки картинок -->

    <?php echo $form->field($model, 'category_id')
        ->dropdownList(
            Category::find() // Создание выпадающего списка | Получение записей из таблицы Category
                ->select(['title', 'id'])   // Получение данных из столбцов title и id
                ->indexBy('id')             // Имя столбца, по которому должны индексироваться результаты запроса.
                ->column(),
            ['prompt' => 'Выберите категорию:']
        ); // Опции элемента
    ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>