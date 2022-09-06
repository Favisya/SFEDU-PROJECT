<?php

namespace App\Blocks;

use App\Database\Database;

class CreateBookBlock extends BlockAbstract
{
    protected $template = 'createBook';

    public function render()
    {
        $authors    = new AuthorsBlock();
        $countries  = new CountriesBlock();
        $publishers  = new PublishersBlock();

        require_once APP_ROOT . '/App/templates/layout.phtml';
    }

    public function getData(): array
    {
        return [''];
    }

    public function createBook()
    {
        $bookName  = $_POST['bookName'];
        $price     = $_POST['bookPrice'];
        $author    = $_POST['authorId'];
        $country   = $_POST['countryId'];
        $publisher = $_POST['publisherId'];
        $date      = $_POST['bookDate'];

        $db = Database::getInstance();
        $stmt = $db->connectDB();

        $query = 'INSERT INTO books (name, price, year, author_id, publisher_id, country_id) values (?, ?, ?, ?, ?, ?)';

        $stmt = $stmt->prepare($query);
        $stmt->execute([$bookName, $price, $date, $author, $publisher, $country]);
    }
}