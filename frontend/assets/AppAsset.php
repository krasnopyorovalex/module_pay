<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/app.min.css',
    ];
    public $js = [
        'js/app.min.js',
        //'js/build.js',
    ];
    public $depends = [
        'yii\web\YiiAsset'
    ];
}
