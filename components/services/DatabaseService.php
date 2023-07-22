<?php

namespace app\components\services;

use yii\db\Query;

class DatabaseService
{
    public Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    public function getBasicDataBooks(int $limit = 10) : array
    {
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
            ->groupBy('book.id')
            ->orderBy(['book.id' => SORT_DESC])
            ->limit(10)
            ->all();

        return $data;
    }
}