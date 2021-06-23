<?php

use app\models\User;

?>
    <div id="comments" class="box">
        <?php if (!empty($comments)) : ?>
            <h3>Коментарии</h3>
            <ol id="singlecomments" class="commentlist">
                <?php foreach ($comments as $comment) : ?>
                    <li>
                        <div class="user avatar avatar-comit">
                            <!-- <img alt="" src="/web/images/art/u1.jpg" class="avatar" />-->
                            <?php $image = User::findOne($comment->user_id)->getImage(); ?>
                            <?= yii\helpers\Html::img($image->getUrl(), ['alt' => $comment->user->username, 'class' => 'avatar-user avatar-comit']); ?>
                        </div>

                        <div class="message">
                            <div class="info">
                                <h2><a href="#"><?= $comment->user->username; ?></a></h2>
                                <div class="meta">
                                    <div class="date"><?= $comment->getDate(); ?></div>
                                    <!--<a class="reply-link" href="#">Reply</a>--> <!-- ссылка для ответа  -->
                                    
                                </div>
                            </div>
                            <p><?= $comment->text ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php else: ?>
            <h3>Коментариев к этой статье нет</h3>
        <?php endif; ?>
        
        <?php if (!Yii::$app->user->isGuest) : ?>
            <hr>
            <div class="coment-form">
                <h2 class="section-title">Ваш коментарий:</h2>
                <?php $form = \yii\widgets\ActiveForm::begin([
                    'action' => ['blog/comment', 'id' => $article->id],
                ]) ?>
                <div class="message-field">
                    <?= $form->field($commentForm, 'comment')->textarea(['class' => 'plan']) ?>
                </div>
                <?= yii\bootstrap\Html::submitButton('Разместить коментарий', ['class' => 'btn']) ?>
                <?php \yii\widgets\ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
