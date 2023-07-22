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
    //TODO добавить фильтры при передаче в get запрос категорий или авторов
    //  это нужно в дальнейшем для поиска
    public function actionIndex(): string
    {
        $model = new SiteModel;

        $vars = $model->getBooksForIndexPage();

        return $this->render('index', $vars);
    }
}
