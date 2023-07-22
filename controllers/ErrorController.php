<?php

namespace app\controllers;

use yii\web\Controller;

class ErrorController extends Controller
{
    public function actions(): array
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
}