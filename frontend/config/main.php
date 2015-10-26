<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'bpm' => [
            'class' => 'common\modules\entity\frontend\Module',
        ],
        'upload' => [
            'class' => 'common\modules\upload\Module',
        ],
        'log' => [
            'class' => 'common\modules\log\Module',
        ],
        'executor' => [
            'class' => 'common\modules\executor\Module',
        ],
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => ['@backend/views' => '@webroot/themes/spacelab/views'],
                'baseUrl' => '@web/themes/spacelab',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
    ],
    'params' => $params,
];
