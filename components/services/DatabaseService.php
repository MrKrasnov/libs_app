<?php

namespace app\components\services;

use app\dto\BookDTO;
use yii\db\Expression;
use yii\db\Transaction;
use Yii;
use yii\db\Exception;
use yii\db\Query;

class DatabaseService
{
    public function getDataBookById(int $id)
    {
        $query = new Query();
        $data  = $query
            ->select('*')
            ->from('book')
            ->where(['id' => $id])
            ->andWhere(['deleted_at' => null])
            ->one();

        return $data;
    }

    /**
     * Получаем общую информацию о книгах, авторах книги и жанре
     *
     * @param int $limit
     * @param array $filter
     * @return array
     */
    public function getBasicDataBooks(int $limit = 10, array $filter = []) : array
    {
        $arrayWhere = [];
        if(!empty($filter)) {
            $arrayWhere = $this->getWhereFromFilter($filter);
        }

        $query = new Query();
        $data  = $query
            ->select([
                'book.id AS book_id',
                'book.title',
                'book.img',
                'GROUP_CONCAT(DISTINCT author.name SEPARATOR ", ") AS authors',
                'GROUP_CONCAT(DISTINCT category.name SEPARATOR ", ") AS categories',
            ])
            ->from('book')
            ->join('LEFT JOIN', 'books_authors', 'book.id = books_authors.books_id')
            ->join('LEFT JOIN', 'author', 'books_authors.authors_id = author.id')
            ->join('LEFT JOIN', 'books_categories', 'book.id = books_categories.books_id')
            ->join('LEFT JOIN', 'category', 'books_categories.categories_id = category.id')
            ->where($arrayWhere)
            ->andWhere(['deleted_at' => null])
            ->groupBy('book.id')
            ->orderBy(['book.id' => SORT_DESC])
            ->limit($limit)
            ->all();

        return $data;
    }

    public function getCategoriesByBookId($bookId) : array
    {
        $query = new Query();
        $data  = $query
            ->select('category.*')
            ->from('book')
            ->join('INNER JOIN', 'books_categories', 'book.id = books_categories.books_id')
            ->join('INNER JOIN', 'category', 'books_categories.categories_id = category.id')
            ->where(['book.id' => $bookId])
            ->all();

        return $data;
    }

    public function getAllCategories() : array
    {
        $query = new Query();
        $data  = $query
            ->select('*')
            ->from('category')
            ->all();

        return $data;
    }

    public function getAuthorsByBookId(int $bookId) : array
    {
        $query = new Query();
        $data  = $query
            ->select('author.*')
            ->from('book')
            ->join('INNER JOIN', 'books_authors', 'book.id = books_authors.books_id')
            ->join('INNER JOIN', 'author', 'books_authors.authors_id = author.id')
            ->where(['book.id' => $bookId])
            ->all();

        return $data;
    }

    public function addCategoriesByBookById(int $id, array $categories) : bool
    {
        foreach ($categories as $categoryId) {
            $query = new Query();
            $resultInsert = $query
                ->createCommand()
                ->insert('books_categories', [
                    'books_id' => $id,
                    'categories_id' => $categoryId,
                ])
                ->execute();

            if($resultInsert > 0){
                Yii::warning('не получилось добавить категорию '. $categoryId . ' для книги '. $id);
            }
        }
        return true;
    }

    public function deleteCategoryByBookId(int $id, array $categories) : bool
    {
        foreach ($categories as $categoryId) {
            $query = new Query();
            $query
                ->createCommand()
                ->delete('books_categories',
                    [
                        'books_id' => $id,
                        'categories_id' => $categoryId
                    ])
                ->execute();
        }
        return true;
    }

    public function addAuthorsByBookById(int $id, array $authors) : bool
    {
        foreach ($authors as $authorId) {
            $query = new Query();
            $resultInsert = $query
                ->createCommand()
                ->insert('books_authors', [
                    'books_id' => $id,
                    'authors_id' => $authorId,
                ])
                ->execute();

            if($resultInsert > 0){
                Yii::warning('не получилось добавить автора '. $authorId . ' для книги '. $id);
            }
        }
        return true;
    }

    public function deleteAuthorsByBookId(int $id, array $authors) : bool
    {
        foreach ($authors as $authorId) {
            $query = new Query();
            $query
                ->createCommand()
                ->delete('books_authors',
                    [
                        'books_id' => $id,
                        'authors_id' => $authorId
                    ])
                ->execute();
        }
        return true;
    }

    public function getAllAuthors() : array
    {
        $query = new Query();
        $data  = $query
            ->select('*')
            ->from('author')
            ->all();

        return $data;
    }

    public function addAuthor(string $author) : bool
    {
        $query = new Query();
        $resultInsert = $query
            ->createCommand()
            ->insert('author', [
                'name' => $author,
            ])
            ->execute();

        return $resultInsert > 0;
    }

    public function addCategory(string $category) : bool
    {
        $query = new Query();
        $resultInsert = $query
            ->createCommand()
            ->insert('category', [
                'name' => $category,
            ])
            ->execute();

        return $resultInsert > 0;
    }

    public function addBook(BookDTO $bookDTO) : bool
    {
        $db = Yii::$app->db;
        $bookData = $bookDTO->toArray();

        //использую транзакцию чтобы в случае ошибки откатить изменения
        $transaction =  $db->beginTransaction();

        if ($transaction === null) {
            throw new Exception("Ошибка старта транзакции при добавлении записи для книги");
        }

        try {
             $db->createCommand()->insert('book', [
                'title'       => $bookData['title'],
                'description' => $bookData['description'],
                'img'         => $bookData['img']
            ])->execute();

            $bookId = $db->getLastInsertID();

            foreach ($bookData['categories'] as $category) {
                $db->createCommand()->insert('books_categories', [
                    'books_id'      => $bookId,
                    'categories_id' => $category,
                ])->execute();
            }

            foreach ($bookData['authors'] as $author) {
                $db->createCommand()->insert('books_authors', [
                    'books_id'      => $bookId,
                    'authors_id'    => $author,
                ])->execute();
            }

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        Yii::error('При Добавлении книги скрипт обошел конструкцию Try Catch такого не должно быть!');
        return false;
    }

    public function updateTitleBookById(int $id, string $title) : bool
    {
        $resultInsert =
            Yii::$app->db->createCommand()
            ->update('book', ['title' => $title], ['id' => $id])
            ->execute();

        $this->updateUpdateDataForBook($id);

        return $resultInsert > 0;
    }

    public function updateDescriptionBookById(int $id, string $description) : bool
    {
        $resultInsert =
            Yii::$app->db->createCommand()
                ->update('book', ['description' => $description], ['id' => $id])
                ->execute();

        $this->updateUpdateDataForBook($id);

        return $resultInsert > 0;
    }

    public function updateImgBookById(int $id, ?string $imgPath) : bool
    {
        $resultInsert =
            Yii::$app->db->createCommand()
                ->update('book', ['img' => $imgPath], ['id' => $id])
                ->execute();

        $this->updateUpdateDataForBook($id);

        return $resultInsert > 0;
    }

    private function updateUpdateDataForBook($bookId) : bool
    {
        $currentDateTime = new Expression('NOW()');

        Yii::$app->db->createCommand()
            ->update('book', ['updated_at' => $currentDateTime], ['id' => $bookId])
            ->execute();

        return true;
    }

    public function deleteBook(int $bookId) : bool
    {
        $currentDateTime = new Expression('NOW()');

        Yii::$app->db->createCommand()
            ->update('book', ['deleted_at' => $currentDateTime], ['id' => $bookId])
            ->execute();

        return true;
    }

    /**
     * делаем where на основе фильтра
     *
     * @param array $filter
     * @return array
     */
    private function getWhereFromFilter(array $filter) : array
    {
        $category   = $filter['category'] ?? null;
        $nameSearch = $filter['nameSearch'];

        if(!isset($category, $nameSearch)) {
            Yii::warning('неправильно передали значение ключей в массив фильтра');
            return [];
        }

        $whereColumn = '';
        switch ($category) {
            case "Name Book":
                $whereColumn = "book.title";
                break;
            case "Author":
                $whereColumn = "author.name";
                break;
            case "Genre":
                $whereColumn = "category.name";
                break;
            default:
                Yii::warning('из комбобокса пришла неправильная категория = ' . $category);
                return [];
        }

        return ['like', $whereColumn, $nameSearch];
    }
}