<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\PublishersModel;

class EditBookResource
{
    public function executeQuery(int $id)
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

        $query = 'SELECT * FROM books WHERE id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        $bookModel = new BookModel();
        $bookModel->setData($stmt->fetch());

        return [
            'authors'    => $authorsModel,
            'categories' => $categoriesModel,
            'countries'  => $countriesModel,
            'publishers' => $publishersModel,
            'book'       => $bookModel,
        ];
    }

    public function editBook(
        string $name,
        string $date,
        int $price,
        int $authorId,
        int $countryId,
        int $publisherId,
        int $categoryId,
        int $id
    ): bool {
        $name = htmlspecialchars($name);
        $price = htmlspecialchars($price);
        $authorId = htmlspecialchars($authorId);
        $countryId = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date = htmlspecialchars($date);
        $categoryId = htmlspecialchars($categoryId);
        $id = htmlspecialchars($id);

        if (
            empty($name)
            || empty($price)
            || empty($authorId)
            || empty($countryId)
            || empty($publisherId)
            || empty($date)
            || empty($categoryId)
            || empty($id)
        ) {
            throw new MvcException('Input is empty');
        }

        $db = Database::getInstance();
        $stmt = $db->getConnection();

        $query = 'UPDATE books SET
                 name = ?,
                 price = ?,
                 year = ?,
                 author_id = ?,
                 publisher_id = ?,
                 country_id = ?
                 where id = ?';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$name, $price, $date, $authorId, $publisherId, $countryId, $id]);

        $query = 'UPDATE books_categories  SET category_id = ? WHERE book_id = ?';

        $stmtThird = $stmt->prepare($query);
        $stmtThird->execute([$categoryId, $id]);

        header("Location: http://localhost:3000/book?id=$id");
        return true;
    }
}
