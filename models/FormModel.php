<?php

namespace app\models;

use app\dto\BookDTO;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\web\BadRequestHttpException;
use yii\web\UploadedFile;

class FormModel extends Model
{
    public function getCategoryAndAuthors() : array
    {
        $allAuthors  = Yii::$app->DatabaseService->getAllAuthors();
        $allCategory = Yii::$app->DatabaseService->getAllCategories();

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

    public function deleteBook() : bool
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $bookID  = $request->post('id');

        if(!isset($bookID)) {
            throw new InvalidArgumentException('Ожидали получить Id книги');
        }

        $resultDelete = Yii::$app->DatabaseService->deleteBook($bookID);
        return $resultDelete;
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

    public function getBookInfo() : array
    {
        $request = Yii::$app->request;
        $id      = $request->get('id');

        if(!isset($id)) {
            Yii::error('Не пришел id книги');
            throw new InvalidArgumentException('Не пришел id книги');
        }

        $bookData      = Yii::$app->DatabaseService->getDataBookById($id);

        if($bookData === false) {
            throw new InvalidConfigException('Книга с указанным идентификатором не найдена.');
        }

        $allCategories = Yii::$app->DatabaseService->getAllCategories();
        $allAuthors    = Yii::$app->DatabaseService->getAllAuthors();

        $authorsBook = Yii::$app->DatabaseService->getAuthorsByBookId($id);
        $authorsNotExistBook = Yii::$app->ArrayHelper->removeDublicateValuesFromArrays($allAuthors, $authorsBook, 'name');
        $categoriesBook = Yii::$app->DatabaseService->getCategoriesByBookId($id);
        $categoriesNotExistBook = Yii::$app->ArrayHelper->removeDublicateValuesFromArrays($allCategories, $categoriesBook, 'name');

        $img        = $bookData['img'] ?? null;

        if(!isset($img)) {
            $bookData['img'] = "img/no-available.jpg";
        }else if(!file_exists($img)) {
            $bookData['img'] = "img/no-available.jpg";
        }

        return [
            'bookData' => $bookData,
            'authorsBook'=> $authorsBook,
            'authorsNotExistBook' => $authorsNotExistBook,
            'categoriesBook' => $categoriesBook,
            'categoriesNotExistBook' => $categoriesNotExistBook
        ];
    }

    public function updateTitle() : bool
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $id      = $request->post('id');
        $title   = $request->post('title');

        if(!isset($id, $title)) {
            throw new InvalidArgumentException('При изменении заголовка книги не получили необходимые данные из запроса');
        }

        $title = trim($title);

        $resultUpdate = Yii::$app->DatabaseService->updateTitleBookById($id, $title);
        return $resultUpdate;
    }

    public function updateDescription() : bool
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $id      = $request->post('id');
        $description   = $request->post('description');

        if(!isset($id, $description)) {
            throw new InvalidArgumentException('При изменении описания книги не получили необходимые данные из запроса');
        }

        $description = trim($description);

        $resultUpdate = Yii::$app->DatabaseService->updateDescriptionBookById($id, $description);
        return $resultUpdate;
    }

    public function updateImage() : bool
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $id      = $request->post('id');

        if(!isset($id)) {
            throw new InvalidArgumentException('При изменении изображения книги не получили идентификатор');
        }

        if( !empty($_FILES['img']) && !empty($_FILES['img']['tmp_name']) ) {
            $imgPath = $this->uploadImageToServer($_FILES['img']);
            if(!isset($imgPath)) {
                Yii::error('Не смогли загрузить изображение на сервер когда обновляли для книги изображение');
                return false;
            }
            $resultUpdate = Yii::$app->DatabaseService->updateImgBookById($id, $imgPath);
            return $resultUpdate;
        } else {
            throw new InvalidArgumentException('При изменении изображения книги не получили файл изображения');
        }

        Yii::error('При изменении изображения книги скрипт обошел return или исключение, такого быть не должно');
        return false;
    }

    public function deleteImage() : bool
    {
        $request = Yii::$app->request;

        if (!$request->isPost) {
            throw new BadRequestHttpException('Неправильный тип запроса');
        }

        $id      = $request->post('id');

        if(!isset($id)) {
            throw new InvalidArgumentException('При удалении изображения книги не получили идентификатор');
        }

        $resultDelete = Yii::$app->DatabaseService->updateImgBookById($id, null);
        return $resultDelete;
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