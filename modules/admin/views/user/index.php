<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <!-- Сесионое сообщение -->
    <?= $this->render('/layouts/inc/session_message'); ?>
    <!-- /Сесионое сообщение -->
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавление пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            //'password',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>