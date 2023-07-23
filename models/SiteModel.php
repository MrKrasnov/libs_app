<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SiteModel extends Model
{
    public function getBooksForIndexPage() : array
    {
        $request = Yii::$app->request;
        $nameSearch = $request->get('name-search');
        $category   = $request->get('category');

        //TODO попробовать упростить код
       if(isset($nameSearch, $category)) {
           $booksData = $this->getBooks($nameSearch, $category);
       } else {
            $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20);
        }

        //проверим данные для книг
        foreach ($booksData as $index => $bookData) {
            $img        = $bookData['img'] ?? null;
            $categories = $bookData['categories'] ?? null;
            $authors    = $bookData['authors'] ?? null;

            if(!isset($categories)) {
                $bookData['categories'] = 'empty';
            }

            if(!isset($authors)) {
                $bookData['authors'] = 'empty';
            }

            if(!isset($img)) {
                $bookData['img'] = "img/no-available.jpg";
            }else if(!file_exists($img)) {
                $bookData['img'] = "img/no-available.jpg";
            }

            $booksData[$index] = $bookData;
        }

        return ['booksData' => $booksData];
    }

    /**
     * @param mixed $nameSearch
     * @param mixed $category
     * @return mixed
     */
    private function getBooks(string $nameSearch, string $category) : array
    {
        if (empty($nameSearch)) {
            Yii::warning('Из поискового инпута пришла пустая строка');
            $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20);
        } else {
            $nameSearch = trim($nameSearch);

            $booksData = Yii::$app->DatabaseService->getBasicDataBooks(20, [
                "category" => $category,
                'nameSearch' => $nameSearch
            ]);
        }
        return $booksData;
    }
}