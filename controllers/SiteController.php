<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_DEV ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $scenario = Yii::$app->user->isGuest ? ContactForm::SCENARIO_GUEST : ContactForm::SCENARIO_USER;
        $model = new ContactForm(['scenario' => $scenario]);
        if (Yii::$app->request->isPost) {
            $model->name = \Yii::$app->request->post('ContactForm')['name'];
            // $model->attributes = Yii::$app->request->post('ContactForm');
            $model->load(Yii::$app->request->post());
            if ($model->validate()) {
                Yii::$app->session->setFlash('contactFormSubmitted');
                return $this->refresh();
            }
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSay($message = 'Hello')
    {
        return $this->render('say', ['message' => $message]);
    }

    public function actionEntry()
    {
        $model = new EntryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $modelJsonString = json_encode($model);
            return $this->redirect(['entry-confirm', 'modelJsonString' => $modelJsonString]);
        } else {
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionOffline()
    {
        return $this->render('offline');
    }

    public function actionEntryConfirm($modelJsonString)
    {
        $model = json_decode($modelJsonString);
        return $this->render('entry-confirm', ['model' => $model]);
    }

    public function actionTestAliases()
    {
        $file = Yii::getAlias('@media/text.txt');
        $content = file_get_contents($file);
        return $this->render('test-aliases', ['content' => $content]);
    }
}
