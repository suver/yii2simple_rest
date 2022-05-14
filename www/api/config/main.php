<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
//         'response' => [
//             'format' => \yii\web\Response::FORMAT_JSON,
//             'formatters' => [
//                 \yii\web\Response::FORMAT_JSON => 'tuyakhov\jsonapi\JsonApiResponseFormatter'
//             ]
//         ],
        'user' => [
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-api',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'flushInterval' => 100,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'exportInterval' => 100,
                    'levels' => ['error', 'warning','info','trace'],
                ],
//                 [
//                     'class' => 'yii\log\SyslogTarget',
//                     'exportInterval' => 100,
//                     'levels' => ['error', 'warning'],
//                 ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'category'],
                ['class' => 'yii\rest\UrlRule', 'controller' => 'product'],
//                 ['class' => 'yii\rest\UrlRule', 'controller' => ['category', 'product', 'site'],],
//                 ['class' => 'tuyakhov\jsonapi\UrlRule', 'controller' => ['category', 'product'],],
//                 'PUT <controller>/<id>' => '<controller>/update',
//                 'DELETE <controller>/<id:\d+>' => '<controller>/delete',
//                 'GET,HEAD <controller>/<id:\d+>' => '<controller>/view',
//                 'POST <controller>' => '<controller>/create',
//                 'GET,HEAD <controller>' => '<controller>/index',
//                 '<controller>/<id:\d+>' => '<controller>/options',
//                 '<controller>' => '<controller>/options',
            ]
        ],
    ],
    'params' => $params,
];
