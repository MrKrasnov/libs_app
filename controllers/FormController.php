<?php

namespace app\controllers;

use app\models\FormModel;
use yii\web\Controller;

class FormController extends Controller
{

    public function actionViewForm(): string
    {
        $model = new FormModel;

        $vars  = $model->getCategoryAndAuthors();

        return $this->render('form', $vars);
    }

    public function actionAddCategory() : string
    {
        $model = new FormModel;

        $resultAdd  = $model->addCategory();

        return $this->render('resultPage', $resultAdd);
    }

    public function actionAddAuthor() : string
    {
        $model = new FormModel;

        $resultAdd  = $model->addAuthor();

        return $this->render('resultPage', $resultAdd);
    }
}