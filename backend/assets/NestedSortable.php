<?php

namespace backend\assets;

use yii\web\AssetBundle;

class NestedSortable extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/dashboard';

    public $css = [
    ];

    public $js = [
        'javascripts/jquery.mjs.nestedSortable.js',
        'javascripts/client_actions_nestedSortable.js',
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}
