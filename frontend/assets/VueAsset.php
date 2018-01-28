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
        'js/build2.min.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}
