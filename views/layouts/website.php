<?php

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
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
  <i class="ri-e-bike-fill"></i>
  <div id="preloader">
    <div id="status">
      <div class="spinner"></div>
    </div>
  </div>
  <div class="body-wrapper wrapper">
    <div class="content">
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header"> <a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
          <div class="navbar-brand text-center"> <a href="<?= Url::home() ?>"><img src="/web/images/logo.png" alt="" data-src="/web/images/logo.png" data-ret="/web/images/logo@2x.png" class="retina" /></a> </div>
          <!-- /.navbar-brand -->
        </div>
        <!-- /.navbar-header -->
        
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <?php if (Yii::$app->user->isGuest) : ?>
              <li><a href="<?= Url::toRoute(['auth/login']) ?>" data-hint="Войти"><i class="budicon-check-2"></i><span>Войти</span></a></li>
            <?php else : ?>
              <li><a href="<?= Url::toRoute(['auth/logout']) ?>" data-hint="Выход"><i class="budicon-cancel-2"></i><span>Выход</span> (<?= Yii::$app->user->identity->username ?>)</a></li>
            <?php endif; ?>
            <?php if (\Yii::$app->user->can('accessAdminPanel')) : ?>
              <li><a href="<?= Url::toRoute(['//admin']) ?>" data-hint="Админ панель"><i class="budicon-setting"></i><span>Админ панель</span></a></li>
            <?php endif; ?>
            <li class="current"><a href="<?= Url::home() ?>" class="hint--right" data-hint="На главную"><i class="budicon-home-1"></i><span>На главную</span></a></li>
            <!--<li><a href="#portfolio" class="hint--right" data-hint="Портфолио"><i class="budicon-image"></i><span>Портфолио</span></a></li>-->
            <!--<li><a href="#about" class="hint--right" data-hint="Обо мне"><i class="budicon-author"></i><span>Обо мне</span></a></li>-->
            <!--<li><a href="#contact" class="hint--right" data-hint="Контакты"><i class="budicon-profile"></i><span>Контакты</span></a></li>-->
            <!--<li><a href="<?= Url::toRoute(['blog/classic']) ?>" class="hint--right" data-hint="Блог"><i class="budicon-book-1"></i><span>Блог</span></a></li>-->
            <li><a href="#elsewhere" class="hint--right fancybox-inline" data-hint="В сотсетях" data-fancybox-width="325" data-fancybox-height="220"><i class="icon-heart-empty-1"></i><span>В сотсетях</span></a></li>
          </ul>
          <!-- /.navbar-nav -->
        </div>
        <!-- /.navbar-collapse -->
        <div id="elsewhere" style="display:none;">
          <h1>Me, Elsewhere</h1>
          <div class="divide20"></div>
          <ul class="social">
            <li><a href="#"><i class="icon-s-twitter"></i></a></li>
            <li><a href="#"><i class="icon-s-facebook"></i></a></li>
            <li><a href="#"><i class="icon-s-instagram"></i></a></li>
            <li><a href="#"><i class="icon-s-flickr"></i></a></li>
            <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
            <li><a href="#"><i class="icon-s-linkedin"></i></a></li>
          </ul>
        </div>
        <!-- /#elsewhere -->
      </nav>
      <!-- /.navbar -->

      <?= $content ?>
    </div>

    <div class="container inner content-footer">
      <footer class="footer box">
        <p class="pull-left">© 2021 LEmanRUS. All rights reserved.</p>
        <ul class="social pull-right">
          <li><a href="#"><i class="icon-s-rss"></i></a></li>
          <li><a href="#"><i class="icon-s-twitter"></i></a></li>
          <li><a href="#"><i class="icon-s-facebook"></i></a></li>
          <li><a href="#"><i class="icon-s-dribbble"></i></a></li>
          <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
          <li><a href="#"><i class="icon-s-instagram"></i></a></li>
          <li><a href="#"><i class="icon-s-vimeo"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer -->
    </div>
    <!-- /.container -->

  </div>
  <!-- /.body-wrapper -->

  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>