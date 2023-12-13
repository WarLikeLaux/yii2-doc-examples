<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Country;

class CountryController extends Controller
{
    public function actionIndex()
    {
        $query = Country::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('index', [
            'countries' => $countries,
            'pagination' => $pagination
        ]);
    }

    public function actionUpdateCountryCode($old, $new)
    {
        $country = Country::findOne($old);
        $country->code = $new;
        $country->save();
        return $this->redirect(["index"]);
    }

    public function actionUpdateCountryName($code, $name)
    {
        $country = Country::findOne($code);
        $country->name = $name;
        $country->save();
        return $this->redirect(["index"]);
    }
}
