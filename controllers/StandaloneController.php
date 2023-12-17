<?php

namespace app\controllers;

class StandaloneController extends \yii\web\Controller
{
    // public $defaultAction = 'hello-world';

    public function init()
    {
        parent::init();
        $this->defaultAction = 'hello-world';
    }

    public function actions()
    {
        return [
            'index' => [
                'class' => 'yii\web\ViewAction',
                'viewPrefix' => '',
                'defaultView' => 'index',
            ],
            'hello-world' => 'app\components\actions\HelloWorldAction',
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'view' => 'error',
            ],
        ];
    }

    public function actionHelloWorld()
    {
        return 'Hello World 2';
    }

    public function actionTest(array $array, $string)
    {
        var_dump($array, $string);
    }

    public function actionForward()
    {
        return $this->redirect('https://google.com');
    }
}
