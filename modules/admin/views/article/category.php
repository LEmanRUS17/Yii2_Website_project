<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('category', $selectidCategory, $categories, ['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Изменить Категорию', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
