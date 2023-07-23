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

        $vars  = $model->getBookInfo();

        return $this->render('updateForm', $vars);
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

    public function actionAddBook(): string
    {
        $model      = new FormModel;

        $resultAdd  = $model->addBook();

        return $this->render('resultInsertPage', $resultAdd);
    }

    public function actionUpdateTitle() : string
    {
        $model      = new FormModel;

        $resultUpdate  = $model->updateTitle();

        return $this->render('resultUpdatePage', ['resultUpdate' => $resultUpdate]);
    }

    public function actionUpdateDescription() : string
    {
        $model      = new FormModel;

        $resultUpdate  = $model->updateDescription();

        return $this->render('resultUpdatePage', ['resultUpdate' => $resultUpdate]);
    }

    public function actionUpdateImage() : string
    {
        $model         = new FormModel;

        $resultUpdate  = $model->updateImage();

        return $this->render('resultUpdatePage', ['resultUpdate' => $resultUpdate]);
    }

    public function actionDeleteImage() : string
    {
        $model         = new FormModel;

        $resultDelete  = $model->deleteImage();

        return $this->render('resultDeletePage', ['resultDelete' => $resultDelete, 'type' => 'image']);
    }

    public function actionDeleteBook(): string
    {
        $model         = new FormModel;

        $resultDelete  = $model->deleteBook();

        return $this->render('resultDeletePage', ['resultDelete' => $resultDelete, 'type' => 'book']);
    }
}