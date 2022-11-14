<?php

namespace App\Models\Resource;

use App\Database\Database;
use App\Exceptions\MvcException;
use App\Models\AuthorModel;
use App\Models\AuthorsModel;
use App\Models\BookModel;
use App\Models\BooksModel;
use App\Models\AbstractModel;
use App\Models\CategoriesModel;
use App\Models\CountriesModel;
use App\Models\LibraryModel;
use App\Models\PublisherModel;
use App\Models\PublishersModel;

class BooksResource extends AbstractResource
{
    public function getBook(int $id, int $limit = 6): AbstractModel
    {
        if (!isset($id)) {
            throw new MvcException('id is wrong');
        }

        $db = $this->database->getConnection();

        $query = 'SELECT
                    a.id,
                    a.name,
                    a.author_id,
                    a.price,
                    a.year AS date,
                    b.name AS author,
                    c.name AS publisher,
                    d.name AS country
                  FROM books AS a 
                  JOIN authors AS b ON a.author_id = b.id
                  JOIN publishers AS c ON a.publisher_id = c.id
                  JOIN countries AS d ON a.country_id = d.id
                  WHERE a.id = ?;';

        $stmtFirst = $db->prepare($query);
        $stmtFirst->execute([$id]);
        $data['info'] = $stmtFirst->fetch();

        if ($data['info'] === false) {
            throw new MvcException('Info not found');
        }

        $query = 'SELECT count(books_libraries.book_id) as count, libraries.name AS name, libraries.id AS id
                  FROM libraries
                  JOIN books_libraries ON libraries.id = books_libraries.library_id
                  WHERE books_libraries.book_id = ? GROUP BY id LIMIT ?;';

        $stmtSecond = $db->prepare($query);
        $stmtSecond->execute([$id, $limit]);

        $libraries = [];
        foreach ($stmtSecond->fetchAll() as $library) {
            $libModel = $this->di->newInstance(LibraryModel::class);
            $libModel->setData($library);
            $libraries[] = $libModel;
        }

        $bookModel = $this->di->get(BookModel::class);
        $bookModel->setData($data['info']);
        $bookModel->setLibs($libraries);

        return $bookModel;
    }

    public function createBook(
        string $name,
        string $date,
        int $price,
        int $authorId,
        int $countryId,
        int $publisherId,
        int $categoryId
    ): AbstractModel {
        $name        = htmlspecialchars($name);
        $price       = htmlspecialchars($price);
        $authorId    = htmlspecialchars($authorId);
        $countryId   = htmlspecialchars($countryId);
        $publisherId = htmlspecialchars($publisherId);
        $date        = htmlspecialchars($date);
        $categoryId  = htmlspecialchars($categoryId);

        $stmt = $this->database->getConnection();

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

        $bookModel = $this->di->get(BookModel::class);
        $bookModel->setData($data);

        return $bookModel;
    }

    public function getBookInfo(int $id = null): array
    {
        $db = $this->database->getConnection();

        $query = 'SELECT * FROM authors';
        $stmt = $db->query($query);
        $authorsModel = $this->di->get(AuthorsModel::class);

        $authors = [];
        foreach ($stmt->fetchAll() as $author) {
            $authorModel = $this->di->newInstance(AuthorModel::class);
            $authorModel->setData($author);
            $authors[] = $authorModel;
        }

        $authorsModel->setData($authors);

        $query = 'SELECT * FROM categories';
        $stmt = $db->query($query);
        $categoriesModel = $this->di->get(CategoriesModel::class);
        $categoriesModel->setData($stmt->fetchAll());

        $query = 'SELECT * FROM countries';
        $stmt = $db->query($query);
        $countriesModel = $this->di->get(CountriesModel::class);
        $countriesModel->setData($stmt->fetchAll());

        $query = 'SELECT * FROM publishers';
        $stmt = $db->query($query);
        $publishersModel = $this->di->get(PublishersModel::class);

        $publishers = [];
        foreach ($stmt->fetchAll() as $publisher) {
            $publisherModel = $this->di->newInstance(PublisherModel::class);
            $publisherModel->setData($publisher);
            $publishers[] = $publisherModel;
        }
        $publishersModel->setData($publishers);

        $bookModel = $this->di->get(BookModel::class);

        if ($id != null) {
            $query = 'SELECT * FROM books WHERE id = ?';
            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
            $bookModel->setData($stmt->fetch());
        }

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


        $stmt = $this->database->getConnection();

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

        $bookModel = $this->di->get(BookModel::class);
        $bookModel->setData($stmtThird->fetch());

        return $bookModel;
    }

    public function deleteBook(int $id): void
    {
        $db = $this->database->getConnection();

        $query = 'DELETE FROM books WHERE id = ?';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    }

    public function takeBook(int $book_id, int $user_id): void
    {
        $db = $this->database->getConnection();

        $query = 'INSERT INTO books_users (book_id, user_id) VALUES (?, ?)';
        $stmt = $db->prepare($query);
        $stmt->execute([$book_id, $user_id]);
    }

    public function getBooks(int $id = 0): AbstractModel
    {
        if (!isset($id)) {
            throw new MvcException('Id is wrong');
        }

        $db = $this->database->getConnection();

        $query = 'SELECT
                        a.id,
                        a.name,
                        a.author_id,
                        a.price,
                        a.year AS date,
                        b.name AS author,
                        c.name AS publisher,
                        d.name AS country
                    FROM books AS a
                     JOIN authors AS b ON a.author_id = b.id
                     JOIN publishers AS c ON a.publisher_id = c.id
                     JOIN countries AS d ON a.country_id = d.id';

        if ($id === 0) {
            $stmt = $db->query($query);
        } else {
            $query .= ' where books.author_id = ?;';

            $stmt = $db->prepare($query);
            $stmt->execute([$id]);
        }

        $books = [];
        foreach ($stmt->fetchAll() as $book) {
            $bookModel = $this->di->newInstance(BookModel::class);
            $bookModel->setData($book);
            $books[] = $bookModel;
        }

        $booksModel = $this->di->get(BooksModel::class);
        $booksModel->setData($books);

        return $booksModel;
    }

    public function getTookenBooks(int $user_id)
    {
        if (!isset($user_id)) {
            throw new MvcException('Id is wrong');
        }

        $db = $this->database->getConnection();

        $query = 'SELECT books.id, books.name FROM books
            JOIN books_users ON books.id = books_users.book_id
            WHERE user_id = ?';

        $stmt = $db->prepare($query);
        $stmt->execute([$user_id]);

        $books = [];
        foreach ($stmt->fetchAll() as $book) {
            $bookModel = $this->di->newInstance(BookModel::class);
            $bookModel->setData($book);
            $books[] = $bookModel;
        }

        $booksModel = $this->di->get(BooksModel::class);
        $booksModel->setData($books);

        return $booksModel;
    }
}
