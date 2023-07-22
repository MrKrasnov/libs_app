<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\Request;

class SiteModel extends Model
{
    public function getBooksForIndexPage() : array
    {
        $request = Yii::$app->request;
        $nameSearch = $request->get('name-search');
        $category   = $request->get('category');

        //TODO попробовать упростить код
       if(isset($nameSearch, $category)) {
           if(empty($nameSearch)) {
               Yii::warning('Из поискового инпута пришла пустая строка');
               $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20);
           } else {
               $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20, [
                   "category"   => $category,
                   'nameSearch' => $nameSearch
               ]);
           }
        } else {
            $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20);
        }

        //проверим есть ли изображение в директории или не равняется ли null
        foreach ($booksData as $index => $bookData) {
            $img = $bookData['img'] ?? null;

            if(!isset($img)) {
                $bookData['img'] = "img/no-available.jpg";
            }else if(!file_exists($img)) {
                $bookData['img'] = "img/no-available.jpg";
            }

            $booksData[$index] = $bookData;
        }

        return ['booksData' => $booksData];
    }
}