<?php

namespace app\controllers;

use \app\models\ContactForm;
use app\models\Country;

class ExploringModelsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAttributes()
    {
        $model = new ContactForm();
        $model->name = 'Name';
        $model['subject'] = 'Subject';

        return $this->render('attributes', [
            'model' => $model,
        ]);
    }

    public function actionAttributeLabels()
    {
        $model = new ContactForm();

        return $this->render('attribute-labels', [
            'model' => $model,
        ]);
    }

    public function actionValidationRules()
    {
        $scenario = \Yii::$app->user->isGuest ? ContactForm::SCENARIO_GUEST : ContactForm::SCENARIO_USER;
        $model = new ContactForm(['scenario' => $scenario]);
        $model->attributes = \Yii::$app->request->post('ContactForm');
        if ($model->validate()) {
            $errors = [];
        } else {
            $errors = $model->errors;
        }
        return $this->render('validation-rules', [
            'errors' => $errors,
        ]);
    }

    public function actionFields() {
        return $this->render('fields', [
            'model' => Country::find()->orderBy('RAND()')->one()->toArray([], ['prettyName']),
        ]);
    }
}
