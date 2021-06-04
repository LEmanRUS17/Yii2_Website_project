<div class="sidebox box widget">
    <h3 class="widget-title section-title">Стиль отображение статей</h3>
    <ul class="layout-switcher">
        <li><a href="<?= yii\helpers\Url::toRoute(['blog/list']) ?>" class="btn btn-small hint--top" data-hint="List View"><i class="icon-menu-1"></i></a></li>
        <li><a href="<?= yii\helpers\Url::toRoute(['blog/grid']) ?>" class="btn btn-small hint--top" data-hint="Grid View"><i class="icon-th-large"></i></a></li>
        <li><a href="<?= yii\helpers\Url::toRoute(['blog/classic']) ?>" class="btn btn-small hint--top active" data-hint="Classic View"><i class="icon-stop-1"></i></a></li>
    </ul>
</div>