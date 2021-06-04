<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-index">

    <!-- Сесионое сооющение -->
    <?= $this->render('/layouts/inc/session_message'); ?>
    <!-- /Сесионое сооющение -->
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить тег', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'title',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
