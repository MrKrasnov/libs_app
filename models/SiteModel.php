<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SiteModel extends Model
{
    public function getBooksForIndexPage() : array
    {
        $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20);

        //проверим есть ли изображение в директории или не равняется ли null
        foreach ($booksData as $index => $bookData) {
            $img = $bookData['img'] ?? null;

            if(!isset($img) || $index === 0) {
                $bookData['img'] = "img/no-available.jpg";
            }else if(!file_exists($img)) {
                $bookData['img'] = "img/no-available.jpg";
            }

            $booksData[$index] = $bookData;
        }

        return ['booksData' => $booksData];
    }
}