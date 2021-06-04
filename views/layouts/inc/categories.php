<?php

use app\modules\admin\models\Category;

$categories = Category::getAll();    // Получение всех категорий

?>

<div class="sidebox box widget">
    <h3 class="widget-title section-title">Категории</h3>
    <ul class="circled">
        <?php foreach ($categories as $category) : ?>
            <li>
                <a href="<?= Yii\helpers\Url::toRoute(['blog/category', 'id' => $category->id]); ?>"><?= $category->title ?></a>
                <span class="post-count"> (<?= $category->getArticlesCount(); ?>)</span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>