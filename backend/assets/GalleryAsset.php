<?php

namespace backend\assets;

use yii\web\AssetBundle;

class GalleryAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/dashboard';

    public $css = [
        'stylesheets/dropzone.min.css'
    ];

    public $js = [
        'javascripts/dropzone.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}
