<?php

namespace app\controllers;

use app\models\FormModel;
use yii\base\InvalidArgumentException;
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

    public function actionAdd(string $type) : string
    {
        $model      = new FormModel;

        switch ($type) {
            case "category":
                $resultAdd  = $model->addCategory();
                break;
            case "author":
                $resultAdd  = $model->addAuthor();
                break;
            case "book":
                $resultAdd  = $model->addBook();
                break;
            default:
                throw new InvalidArgumentException('Неправильный тип данных для добавления');
        }

        return $this->render('resultInsertPage', $resultAdd);
    }

    public function actionUpdate(string $type) : string
    {
        $model      = new FormModel;

        switch ($type) {
            case "title":
                $resultUpdate  = $model->updateTitle();
                break;
            case "description":
                $resultUpdate  = $model->updateDescription();
                break;
            case "image":
                $resultUpdate  = $model->updateImage();
                break;
            case "categories":
                $resultUpdate  = $model->updateCategories();
                break;
            case "authors":
               // $resultUpdate  = $model->updateImage();
                break;
            default:
                throw new InvalidArgumentException('Неправильный тип данных для обновления');
        }

        return $this->render('resultUpdatePage', ['resultUpdate' => $resultUpdate]);
    }

    public function actionDelete(string $type) : string
    {
        $model      = new FormModel;

        switch ($type) {
            case "image":
                $resultDelete  = $model->deleteImage();
                break;
            case "book":
                $resultDelete  = $model->deleteBook();
                break;
            case "categories":
               // $resultDelete  = $model->deleteBook();
                break;
            case "authors":
               // $resultDelete  = $model->deleteBook();
                break;
            default:
                throw new InvalidArgumentException('Неправильный тип данных для удаления');
        }

        return $this->render('resultDeletePage', ['resultDelete' => $resultDelete, 'type' => $type]);
    }
}