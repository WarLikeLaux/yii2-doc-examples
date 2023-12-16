<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db-local.php';
$extensions = require dirname(__DIR__) . '/vendor/yiisoft/extensions.php';

$config = [
    'id' => 'basic',
    'name' => 'yii2-doc-examples',
    'version' => '1.0',
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'Europe/Moscow',
    'charset' => 'UTF-8',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@media' => '@app/media',
        '@views' => '@app/views',
    ],
    'defaultRoute' => 'site',
    'layout' => 'main', # can set "false" for disabled layout
    'layoutPath' => '@views/layouts',
    'runtimePath' => '@app/runtime',
    'viewPath' => '@views',
    'vendorPath' => '@app/vendor',
    'extensions' => $extensions,
    'basePath' => dirname(__DIR__),
    'on beforeRequest' => function ($event) {
        Yii::$app->name = 'yii2-doc-examples-new';
    },
    'on afterRequest' => function ($event) {
        $response = Yii::$app->response;
        $request = Yii::$app->request;
        $statusCode = $response->statusCode;
        $method = $request->method;
        $url = $request->getUrl();
        Yii::info("Request completed with status code {$statusCode}, method: {$method}, URL: {$url}", 'afterRequest');
    },
    'on beforeAction' => function ($event) {
        $action = $event->action;
        $controller = $action->controller;
        if (Yii::$app->user->isGuest) {
            if ($controller->id !== 'site' || $action->id !== 'login') {
                return $controller->redirect(['site/login']);
            }
        }
    },
    'on afterAction' => function ($event) {
        $action = $event->action;
        $controller = $action->controller;
        $request = Yii::$app->request;
        $actionId = $action->id;
        $controllerId = $controller->id;
        $requestMethod = $request->method;
        Yii::info("Action '{$actionId}' completed successfully for controller '{$controllerId}' using HTTP method '{$requestMethod}'", 'afterRequest');
    },
    'bootstrap' => [
        'log',
        function () {
            return YII_ENV_DEV ? Yii::$app->getModule('debug') : null;
        },
        function () {
            return YII_ENV_DEV ? Yii::$app->getModule('gii') : null;
        },
    ],
    // 'catchAll' => [
    //     'site/offline',
    // ],
    'controllerMap' => [
        'country-secret' => [
            'class' => 'app\controllers\CountryController',
            // 'viewPath' => '@app/views/country',
        ]
    ],
    'controllerNamespace' => 'app\controllers',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Nv0qaqJjFyxusnHcs4kZfftDqEo1sETO',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@app/runtime/logs/info.log',
                    'categories' => ['afterRequest'],
                    'logVars' => [],
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
    ],
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1'],
        ]
    ],
    'params' => $params,
];

if (array_key_exists('catchAll', $config)) {
    unset($config['bootstrap'][1]);
}

return $config;
