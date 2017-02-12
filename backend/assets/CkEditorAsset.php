<?php

namespace backend\assets;

use yii\web\AssetBundle;

class CkEditorAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/dashboard/ckeditor';

    public $css = [
    ];

    public $js = [
        'ckeditor.js',
        'adapters/jquery.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}
