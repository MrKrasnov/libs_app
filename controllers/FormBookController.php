<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class FormBookController extends Controller
{


    public function actionViewForm()
    {
        return $this->render('add');
    }
}