<?php

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\modules\admin\assets\Asset;

Asset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/web/images/favicon.png">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerCsrfMetaTags() ?>
    <?php $this->head() ?>
</head>

<body class="full-layout">
    <?php $this->beginBody() ?>

    <div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'На главную',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Публикации', 'url' => ['/admin/article']],
            ['label' => 'Теги', 'url' => ['/admin/tag']],
            ['label' => 'Категории', 'url' => ['/admin/category']],
            ['label' => 'Пользователи', 'url' => ['/admin/user']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= $content ?>
    </div>
</div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>