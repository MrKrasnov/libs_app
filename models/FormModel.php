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
}