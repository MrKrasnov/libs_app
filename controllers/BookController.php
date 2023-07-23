<?php

namespace app\controllers;

use app\models\BookModel;
use Yii;
use yii\web\Controller;

class BookController extends Controller
{
    public function actionPage() : string
    {
        $model = new BookModel;

        $vars  = $model->getBookInfo();
        $vars['csrf'] = Yii::$app->request->getCsrfToken();

        return $this->render('page', $vars);
    }
}