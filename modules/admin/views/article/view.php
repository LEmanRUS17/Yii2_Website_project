<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */


$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <!-- Сесионое сооющение -->
    <?= $this->render('/layouts/inc/session_message'); ?>
    <!-- /Сесионое сооющение -->
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы дуйствительно хотите удалить публикацию?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Изменить категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить теги', ['set-tags', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <?php $image = $model->getImage(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:raw',
            'date',
            'viewed',
            'user_id',
            'status',
            [
                'attribute' => 'category_id',
                'value'     =>  $category->title,
            ],
            [
                'attribute' => 'image',
                'value'     => "<img src='{$image->getUrl()}' class='image'>",
                'format'    => 'html',
            ],
            
        ],
    ]) ?>
</div>
