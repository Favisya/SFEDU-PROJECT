<?php

namespace App\Controllers;

use App\Blocks\CreateBookBlock;
use App\Database\Database;

class CreateBookController implements ControllerInterface
{
    public function execute()
    {
        $block = new CreateBookBlock();

        if (REQUEST_METHOD == 'GET') {
            $block->render();
        } else {
            $this->createBook();
        }
    }

    private function createBook(): bool
    {
        if (
            !isset($_POST['bookName'])
            || !isset($_POST['bookPrice'])
            || !isset($_POST['authorId'])
            || !isset($_POST['countryId'])
            || !isset($_POST['publisherId'])
            || !isset($_POST['bookDate'])
        ) {
            return false;
        }

        $bookName  = htmlspecialchars($_POST['bookName']);
        $price     = htmlspecialchars($_POST['bookPrice']);
        $author    = $_POST['authorId'];
        $country   = $_POST['countryId'];
        $publisher = $_POST['publisherId'];
        $date      = $_POST['bookDate'];

        $db   = Database::getInstance();
        $stmt = $db->connectDB();

        $query = 'INSERT INTO books (name, price, year, author_id, publisher_id, country_id) VALUES (?, ?, ?, ?, ?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$bookName, $price, $date, $author, $publisher, $country]);

        $query = 'SELECT id FROM books WHERE name = ? AND author_id = ? AND publisher_id = ? LIMIT 1;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$bookName, $author, $publisher]);

        $id = $stmtSecond->fetch()['id'];
        header("Location: http://localhost:3000/book?id=$id");
        return true;
    }
}
