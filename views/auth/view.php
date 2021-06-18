<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$this->params['breadcrumbs'][] = $this->title;
$img = $model->getImage();
?>

<div class="container inner">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="classic-view row">
        <div class="col-md-8 col-sm-12 info-user box">
            <?= Html::a('Редактировать информацию', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'email',
                    'description',
                ],
            ]) ?>
        </div>

        <div class="col-md-4 col-sm-12 avatar-user">
            <?php Pjax::begin(); ?>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'action' => '/example/pjax/pjax-example-5', 'data-pjax' => ''], 'id' => 'input__avatar']); ?>
            <div class="avatar">
                <?= Html::img($img->getUrl(), ['alt' => $model->username, 'class' => 'avatar-user', 'labels' => '']); ?>
            </div>
                        
            <div class="form-group">
                <label class="btn btn-gray selection">
                    <?= $form->field($model, 'image')->fileInput(['id' => 'input__file', 'class' => 'input__file'])->label('Изменить изображение'); ?>
                </label>
                <!--<div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-gray', 'name' => 'login-button']) ?>
            </div>-->
            </div>
            <?php ActiveForm::end(); ?>

            <?php Pjax::end(); ?>
        </div>

    </div>
</div>