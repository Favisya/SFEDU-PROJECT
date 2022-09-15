<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\ModelAbstract;
use App\Models\PublishersModel;

class CreateBookResource
{
    public function executeQuery(): array
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * FROM authors';
        $stmt = $db->query($query);
        $authorsModel = new AuthorsModel();
        $authorsModel->setData($stmt->fetchAll());

        $query = 'SELECT * FROM categories';
        $stmt = $db->query($query);
        $categoriesModel = new CategoriesModel();
        $categoriesModel->setData($stmt->fetchAll());

        $query = 'SELECT * FROM countries';
        $stmt = $db->query($query);
        $countriesModel = new CountriesModel();
        $countriesModel->setData($stmt->fetchAll());

        $query = 'SELECT * FROM publishers';
        $stmt = $db->query($query);
        $publishersModel = new PublishersModel();
        $publishersModel->setData($stmt->fetchAll());

        $bookModel = new BookModel();

        return [
            'authors'    => $authorsModel,
            'categories' => $categoriesModel,
            'countries'  => $countriesModel,
            'publishers' => $publishersModel,
            'book'       => $bookModel,
        ];
    }

    public function createBook(
        string $name,
        string $date,
        int $price,
        int $authorId,
        int $countryId,
        int $publisherId,
        int $categoryId
    ): ModelAbstract {
        $name        = htmlspecialchars($name);
        $price       = htmlspecialchars($price);
        $authorId    = htmlspecialchars($authorId);
        $countryId   = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date        = htmlspecialchars($date);
        $categoryId  = htmlspecialchars($categoryId);

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'INSERT INTO books (name, price, year, author_id, publisher_id, country_id) VALUES (?, ?, ?, ?, ?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$name, $price, $date, $authorId, $publisherId, $countryId]);

        $query = 'SELECT * FROM books WHERE name = ? AND author_id = ? AND publisher_id = ? LIMIT 1;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$name, $authorId, $publisherId]);

        $data = $stmtSecond->fetch();

        $query = 'INSERT INTO books_categories (book_id, category_id) VALUES (?, ?)';

        $stmtThird = $stmt->prepare($query);
        $stmtThird->execute([$data['id'], $categoryId]);

        $bookModel = new BookModel();
        $bookModel->setData($data);

        return $bookModel;
    }
}
