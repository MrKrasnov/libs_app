<?php

namespace app\controllers;

use yii\web\Controller;

class FormBookController extends Controller
{

    public function actionViewForm(): string
    {
        return $this->render('add');
    }
}