<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Models\AuthorModel;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\AbstractModel;
use App\Models\PublisherModel;
use App\Models\PublishersModel;

class EditBookResource
{
    public function executeQuery(int $id): array
    {
        $db = Database::getInstance()->getConnection();

        $query = 'SELECT * FROM authors';
        $stmt = $db->query($query);
        $authorsModel = new AuthorsModel();

        $authors = [];
        foreach ($stmt->fetchAll() as $author) {
            $authorModel = new AuthorModel();
            $authorModel->setData($author);
            $authors[] = $authorModel;
        }

        $authorsModel->setData($authors);

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

        $publishers = [];
        foreach ($stmt->fetchAll() as $publisher) {
            $publisherModel = new PublisherModel();
            $publisherModel->setData($publisher);
            $publishers[] = $publisherModel;
        }
        $publishersModel->setData($publishers);

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
    ): AbstractModel {
        $name        = htmlspecialchars($name);
        $price       = htmlspecialchars($price);
        $authorId    = htmlspecialchars($authorId);
        $countryId   = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date        = htmlspecialchars($date);
        $categoryId  = htmlspecialchars($categoryId);
        $id          = htmlspecialchars($id);

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

        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$categoryId, $id]);

        $query = 'SELECT * FROM books WHERE id = ? LIMIT 1;';
        $stmtThird = $stmt->prepare($query);
        $stmtThird->execute([$id]);

        $bookModel = new BookModel();
        $bookModel->setData($stmtThird->fetch());

        return $bookModel;
    }
}
