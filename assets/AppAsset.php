<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/plugins.css',
        'css/prettify.css',
        'css/color/green.css',
        'css/style.css',
        'http://fonts.googleapis.com/css?family=Raleway:400,800,700,600,500,300',
        'http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic',
        'type/fontello.css',
        'type/budicons.css',
    ];
    public $js = [
        'js/jquery.themepunch.tools.min.js',
        'js/bootstrap.min.js',        
        'js/classie.js',
        'js/plugins.js',
        'js/scripts.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}

