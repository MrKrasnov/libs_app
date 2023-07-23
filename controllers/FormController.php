<?php

namespace app\controllers;

use app\models\FormModel;
use yii\web\Controller;

class FormController extends Controller
{
    public function actionViewAddForm(): string
    {
        $model = new FormModel;

        $vars  = $model->getCategoryAndAuthors();

        return $this->render('addForm', $vars);
    }

    public function actionViewUpdateForm(): string
    {
        $model = new FormModel;

        //$vars = $model->

        return $this->render('updateForm', []);
    }

    public function actionAddCategory() : string
    {
        $model = new FormModel;

        $resultAdd  = $model->addCategory();

        return $this->render('resultInsertPage', $resultAdd);
    }

    public function actionAddAuthor() : string
    {
        $model      = new FormModel;

        $resultAdd  = $model->addAuthor();

        return $this->render('resultInsertPage', $resultAdd);
    }

    public function actionAddBook()
    {
        $model      = new FormModel;

        $resultAdd  = $model->addBook();

        return $this->render('resultInsertPage', $resultAdd);
    }

    public function actionDeleteBook() {
        $model         = new FormModel;

        $resultDelete  = $model->deleteBook();

        return $this->render('resultDeletePage', ['resultDelete' => $resultDelete]);
    }
}