<?php

namespace app\controllers;

use app\models\BookModel;
use yii\web\Controller;

class BookController extends Controller
{
    public function actionPage() : string
    {
        $model = new BookModel;

        $vars  = $model->getBookInfo();

        return $this->render('page', $vars);
    }
}