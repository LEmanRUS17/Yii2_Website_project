<?php

use app\modules\admin\models\Article;
use app\modules\admin\models\Comment;
use yii\helpers\Html;
use yii\helpers\Url;

$popular = Article::getPopular(); // Получение популярных статей

?>

<div class="sidebox box widget">
    <h3 class="widget-title section-title">Популярные посты</h3>
    <ul class="post-list">
        <?php foreach ($popular as $article) : ?>
            <?php $image = $article->getImage(); ?>
            <li>
                <figure class="frame pull-left">
                    <div class="icon-overlay">
                        <a href="<?= Url::toRoute(['blog/post', 'id' => $article->id]) ?>" >
                            <?= Html::img($image->getUrl(), ['alt' => $article->title, 'style' => ['height' => '70px']]); ?>
                        </a>
                    </div>
                </figure>
                <div class="meta"> <em><span class="date"><?= $article->getDate(); ?></span><span class="comments"><a href="#"><?= Comment::numberOfComments($article->id) ?> <i class="icon-chat-1"></i></a></span></em>
                    <h5><a href="<?= Url::toRoute(['blog/post', 'id' => $article->id]) ?>"><?= $article->title ?></a></h5>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <!-- /.post-list -->
</div>