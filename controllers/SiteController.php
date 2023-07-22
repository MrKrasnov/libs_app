<?php

namespace app\controllers;

use app\models\SiteModel;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(): string
    {
        $model = new SiteModel;

        $vars = $model->getBooksForIndexPage();

        return $this->render('index', $vars);
    }
}
