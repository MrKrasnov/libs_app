<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FormModel extends Model
{
    public function getCategoryAndAuthors() : array
    {
        $allAuthors  = Yii::$app->DatabaseService->getAllAuthors();
        $allCategory = Yii::$app->DatabaseService->getAllCategory();

        return [
            'authors'   => $allAuthors,
            'categories'=> $allCategory
        ];
    }

    public function addCategory() : array
    {
        $request = Yii::$app->request;
        $category = $request->post('category');

        if($category === false) {
            Yii::error('Не правильный запрос, записать категорию не удалось');
            return [
                'resultAdd' => false,
            ];
        }

        $category = trim($category);
        $category = strtolower($category);

        $resultAdd = Yii::$app->DatabaseService->addCategory($category);

        return [
            'resultAdd' => $resultAdd,
            'type'      => 'genre',
            'value'     => $category,
        ];
    }

    public function  addAuthor() : array
    {
        $request = Yii::$app->request;
        $author = $request->post('author');

        if($author === false) {
            Yii::error('Не правильный запрос, записать автора не удалось');
            return [
                'resultAdd' => false,
            ];
        }

        $author = trim($author);

        $resultAdd = Yii::$app->DatabaseService->addAuthor($author);

        return [
            'resultAdd' => $resultAdd,
            'type'      => 'author',
            'value'     => $author,
        ];
    }
}