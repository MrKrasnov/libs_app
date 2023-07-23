<?php

namespace app\models;

use Yii;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\base\Model;

class BookModel extends Model
{
    public function getBookInfo() : array
    {
        $request = Yii::$app->request;
        $id      = $request->get('id');

        if(!isset($id)) {
            Yii::error('на страницу книги не пришел ожидаемый параметр в GET запросе');
            throw new InvalidArgumentException('на страницу книги не пришел ожидаемый параметр в GET запросе');
        }

        $bookData = Yii::$app->DatabaseService->getDataBookById($id);

        if($bookData === false) {
            throw new InvalidConfigException('Книга с указанным идентификатором не найдена.');
        }

        $img        = $bookData['img'] ?? null;

        if(!isset($img)) {
            $bookData['img'] = "img/no-available.jpg";
        }else if(!file_exists($img)) {
            $bookData['img'] = "img/no-available.jpg";
        }

        return $bookData;
    }
}