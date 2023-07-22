<?php

namespace app\components\services;

use Yii;
use yii\db\Query;

class DatabaseService
{
    public Query $query;

    public function __construct()
    {
        $this->query = new Query();
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

        $data = $this->query
            ->select([
                'book.id AS book_id',
                'book.title',
                'book.img',
                'GROUP_CONCAT(DISTINCT author.name SEPARATOR ", ") AS authors',
                'GROUP_CONCAT(DISTINCT category.name SEPARATOR ", ") AS categories',
            ])
            ->from('book')
            ->join('INNER JOIN', 'books_authors', 'book.id = books_authors.books_id')
            ->join('INNER JOIN', 'books_categories', 'book.id = books_categories.books_id')
            ->join('INNER JOIN', 'author', 'books_authors.authors_id = author.id')
            ->join('INNER JOIN', 'category', 'books_categories.categories_id = category.id')
            ->where($arrayWhere)
            ->groupBy('book.id')
            ->orderBy(['book.id' => SORT_DESC])
            ->limit($limit)
            ->all();

        return $data;
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