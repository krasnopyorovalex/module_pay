<?php

namespace backend\assets;

use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/dashboard';

    public $css = [
        'stylesheets/application.css',
        'stylesheets/main.css',
        'stylesheets/override.css'
    ];

    public $js = [
        'javascripts/application.js',
        'javascripts/dashboard_bundle.min.js'
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}