<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => require(__DIR__ . '/modules.php'),
    'language' => 'ru',
    'timeZone'=>'Europe/Moscow',
    'homeUrl' => '/_root/',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'request' => [
            'baseUrl' => '/_root',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index',
                '<action:(login|logout|upload-image-ckeditor|profile|multiupload-rooms)>' => 'site/<action>',
                '<_m:[\wd-]+>/<action:(items|add-item|edit-item|delete-item|sorting)>/<id:\d+>' => '<_m>/items/<action>',
                '<_m:[\wd-]+>' => '<_m>/default/index',
                '<_m:[\wd-]+>/<action:[\wd-]+>/<id:[\d]+>' => '<_m>/default/<action>',
                '<_m:[\wd-]+>/<action:[\wd-]+>' => '<_m>/default/<action>',
            ],
        ],
    ],
    'params' => $params,
];
