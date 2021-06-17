<?php

use app\models\User;

$author = User::findOne($id);
$image = $author->getImage();

?>

<?php if ($author) : ?>
    <div class="about-author box">
        <div class="author-image frame">
            <?= yii\helpers\Html::img($image->getUrl(), ['alt' => $author->username, 'class' => 'avatar-user']); ?>
        </div>
        <div class="author-details">
            <h3>Автор: <?= $author->username ?></h3>
            <p><?= $author->description ?></p>
            <ul class="social">
                <li><a href="#"><i class="icon-s-twitter"></i></a></li>
                <li><a href="#"><i class="icon-s-facebook"></i></a></li>
                <li><a href="#"><i class="icon-s-pinterest"></i></a></li>
                <li><a href="#"><i class="icon-s-dribbble"></i></a></li>
                <li><a href="#"><i class="icon-s-linkedin"></i></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
<?php endif; ?>