<?php

use app\modules\admin\models\Comment;
use app\modules\admin\models\Category;
use yii\helpers\Url;

$image = $article->getImage();
?>

<div class="container inner">
    <div class="single blog row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">
                <div class="post box">
                    <div class="meta">
                        <span class="category">
                            <a href="<?= Url::toRoute(['blog/category', 'id' => $article->category_id]) ?>" >
                                <?= Category::getCategory($article->category_id) ?>
                            </a>
                        </span>
                        <span class="date">
                            <?= $article->getDate(); ?>
                        </span>
                        <!--<span class="comments">
                            <a href="#"><?= Comment::numberOfComments($article->id) ?>
                                <i class="icon-chat-1"></i>
                            </a>
                        </span>-->
                    </div>
                    <h2 class="post-title">
                        <a href="blog-post.html">
                            <?= $article->title ?>
                        </a>
                    </h2>
                    <p><?= $article->description ?></p>
                    <figure class="frame">
                        <?= yii\helpers\Html::img($image->getUrl(), ['alt' => $article->title]); ?>
                    </figure>
                    <?= $article->content ?>
                    <div class="meta tags">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?= yii\helpers\Url::toRoute(['blog/tag', 'id' => $tag->id]) ?>"><?= $tag->title ?></a>
                        <?php endforeach; ?>
                    </div>
                    <!-- /.tags -->
                </div>
                <!-- /.post -->
            </div>
            <!-- /.blog-posts -->

            <div class="divide20"></div>

            <?= $this->render('//layouts/inc/about_author', ['id' => $article->user_id]) ?>
            <!-- /.about-author -->

            <div class="divide20"></div>

            <?//= $this->render('//layouts/inc/coments') ?>
            <!-- /#comments -->

            <div class="divide20"></div>

            <?//= $this->render('//layouts/inc/contact') ?>
            <!-- /.comment-form-wrapper -->

        </div>
        <!-- /.content -->

        <aside class="col-md-4 col-sm-12 sidebar">

            <?= $this->render('//layouts/inc/popular_posts') ?>
            <?//= $this->render('//layouts/inc/elsewhere') ?>
            <?= $this->render('//layouts/inc/categories') ?>
            <?= $this->render('//layouts/inc/tags') ?>

        </aside>
        <!-- /.widget -->

    </div>
    <!-- /.blog -->

</div>
<!-- /.container -->