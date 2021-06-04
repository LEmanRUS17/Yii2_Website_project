<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <!-- Сесионое сооющение -->
    <?= $this->render('/layouts/inc/session_message'); ?>
    <!-- /Сесионое сооющение -->
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить Публикацию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            //'content:ntext',
            'date',
            'viewed',
            //'user_id',
            'status',
            //'category_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
