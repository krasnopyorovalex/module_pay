<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/build.min.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
