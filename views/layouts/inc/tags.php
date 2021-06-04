<?php

use app\modules\admin\models\Tag;

$tags = Tag::getAll(); // Получение списка тегов
?>
<div class="sidebox box widget">
    <h3 class="widget-title section-title">Теги</h3>
    <ul class="tag-list">
        <?php foreach($tags as $tag): ?>
            <li><a href="<?= Yii\helpers\Url::toRoute(['blog/tag', 'id' => $tag->id]); ?>" class="btn"><?= $tag->title ?></a></li>
        <?php endforeach; ?>
    </ul>
    <!-- /.tag-list -->
</div>