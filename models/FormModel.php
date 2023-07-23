<?php

namespace app\models;

use app\dto\BookDTO;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

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

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

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

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

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

    public function addBook() : array
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $title              = $request->post('bookTitle');
        $bookDescription    = $request->post('bookDescription');
        $idAuthors          = $request->post('authors');
        $idCategories       = $request->post('categories');

        if(!isset($title, $bookDescription, $idAuthors, $idCategories)) {
            throw new InvalidArgumentException('При добавлении новой книги не получили необходимые данные из запроса');
        }

        $imgPath = null;
        if( !empty($_FILES['image']) && !empty($_FILES['image']['tmp_name']) ) {
            $imgPath = $this->uploadImageToServer($_FILES['image']);
        }

        $bookDTO = new BookDTO();
        $bookDTO
            ->setTitle($title)
            ->setDescription($bookDescription)
            ->setAuthors($idAuthors)
            ->setCategories($idCategories)
            ->setImg($imgPath);

        $resultAdd = Yii::$app->DatabaseService->addBook($bookDTO);

        return [
            'resultAdd' => $resultAdd,
            'type'      => 'book',
            'value'     => $title,
        ];
    }

    private function isValidImgFile(array $file) : bool
    {
        $fileType = $file['type'];
        $photoMimeTypes = array(
            'image/jpeg',
            'image/png',
        );

        if (in_array($fileType, $photoMimeTypes, true)) {
            return true;
        }

        return false;
    }

    private function uploadImageToServer(array $imgFile) : ?string
    {
        if(!$this->isValidImgFile($imgFile)) {
            Yii::error('Файл с изображением имеет не правильный тип, изображение не удалось загрузить');
            return null;
        }

        $fileSize = $imgFile["size"];

        $maxFileSize = 2 * 1024 * 1024; // 2 МБ в байтах
        if ($fileSize > $maxFileSize) {
            Yii::error('Файл с изображением превышает память в 2мб');
            return null;
        }

        $fileName = $imgFile['name'];
        $tmp_name = $imgFile['tmp_name'];

        $resultUpload = Yii::$app->FileService->uploadImg($tmp_name, $fileName);
        return $resultUpload;
    }
}