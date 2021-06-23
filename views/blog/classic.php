<?php

use app\models\Comment;
use app\modules\admin\models\Category;

?>
<div class="container inner">
    <div class="blog classic-view row">
        <div class="col-md-8 col-sm-12 content">
            <div class="blog-posts">

                <?php if ($info) : ?>
                    <div class="post box">
                        <h3><?= $info . $name ?></h3>
                    </div>
                <?php endif; ?>

                <?php foreach ($articles as $article) : ?>
                    <?php $image = $article->getImage(); ?>
                    <div class="post box">
                        <figure class="frame main">
                            <a href="<?= yii\helpers\Url::toRoute(['blog/post', 'id' => $article->id]) ?>">
                                <div class="text-overlay">
                                    <div class="info">
                                        <span>Открыть статью</span>
                                    </div>
                                </div>
                                <?= yii\helpers\Html::img($image->getUrl(), ['alt' => $article->title]); ?>
                            </a>
                        </figure>
                        <div class="meta">
                            <span class="category">
                                <a href="<?= yii\helpers\Url::toRoute(['blog/category', 'id' => $article->category_id]) ?>">
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
                        <h2 class="post-title"><a href="<?= yii\helpers\Url::toRoute(['blog/post', 'id' => $article->id]) ?>"><?= $article->title ?></a></h2>
                        <p><?= $article->description ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- /.blog-posts -->

            <div class="pagination box">
                <?= yii\widgets\LinkPager::widget([
                    'pagination'                    => $pagination,
                    'options'                       => ['class' => ''],    // Вариант css для контейнера 
                    'prevPageLabel'                 => 'Prev',             // Предыдущее значение опциона
                    'nextPageLabel'                 => 'Next',             // Следующее значение опции 
                    'linkOptions'                   => ['class' => 'btn'], // Css для каждой опции. Ссылки
                    'disabledListItemSubTagOptions' => ['class' => 'btn'], // Css для непктивного элемента
                ]); ?>
            </div>

            <!-- /.pagination -->

        </div>
        <!-- /.content -->

        <!-- widgets -->
        <aside class="col-md-4 col-sm-12 sidebar">

            <? //= $this->render('//layouts/inc/layout_switcher') 
            ?>
            <?= $this->render('//layouts/inc/popular_posts') ?>
            <? //= $this->render('//layouts/inc/elsewhere') 
            ?>
            <?= $this->render('//layouts/inc/categories') ?>
            <?= $this->render('//layouts/inc/tags') ?>

        </aside>
        <!-- /.widgets -->

    </div>
</div>