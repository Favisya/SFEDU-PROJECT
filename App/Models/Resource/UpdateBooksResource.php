<?php

namespace App\Models\Resource;

use App\Database\Database;
use GuzzleHttp;

class UpdateBooksResource
{
    public function parseNewBooks()
    {
        $client = new GuzzleHttp\Client();
        $data = $client->request('GET', 'https://api.itbook.store/1.0/new');
        $data = json_decode($data->getBody(), true);
        $books = $data['books'];

        $bookResource = new BookResource();
        foreach ($books as $book) {
            $client = new GuzzleHttp\Client();
            $bookDetailed = $client->request(
                'GET',
                'https://api.itbook.store/1.0/books/' . $book['isbn13']
            );
            $bookDetailed = json_decode($bookDetailed->getBody(), true);

            $price = $this->convertPrice($bookDetailed['price']);
            $date  = $this->convertDate($bookDetailed['year']);
            $countryId    = $this->checkCountry();
            $authorId     = $this->checkAuthor($bookDetailed['authors']);
            $publisherId  = $this->checkPublisher($bookDetailed['publisher']);
            $categoryId   = $this->checkCategory($bookDetailed['subtitle']);

            $bookResource->createBook(
                $bookDetailed['title'],
                $date,
                $price,
                $authorId,
                $countryId,
                $publisherId,
                $categoryId
            );
        }
    }


    private function checkCategory(string $category): int
    {
        if ($category == '') {
            $category = 'unnamed';
        }

        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM categories WHERE name = ?';
        $stmt1 = $db->prepare($query);
        $stmt1->execute([$category]);
        $data = $stmt1->fetch();

        if ($data['name'] == $category) {
            return $data['id'];
        }
        $query = 'INSERT INTO categories (name) value (?);';
        $stmt2 = $db->prepare($query);
        $stmt2->execute([$category]);
        return $this->checkCategory($category);
    }

    private function checkAuthor(string $author): int
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM authors WHERE name = ?';
        $stmt1 = $db->prepare($query);
        $stmt1->execute([$author]);

        $data = $stmt1->fetch();
        if ($data['name'] == $author) {
            return $data['id'];
        }
        $query = 'INSERT INTO authors (name) value (?);';
        $stmt2 = $db->prepare($query);
        $stmt2->execute([$author]);
        return $this->checkAuthor($author);
    }

    private function checkPublisher(string $publisher): int
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM publishers WHERE name = ?';
        $stmt1 = $db->prepare($query);
        $stmt1->execute([$publisher]);

        $data = $stmt1->fetch();
        if ($data['name'] == $publisher) {
            return $data['id'];
        }
        $query = 'INSERT INTO publishers (name, address) value (?, ?);';
        $stmt2 = $db->prepare($query);
        $stmt2->execute([$publisher, $publisher]);
        return $this->checkPublisher($publisher);
    }

    private function checkCountry(): int
    {
        $db = Database::getInstance()->getConnection();
        $query = 'SELECT * FROM countries where name = ?';
        $name = 'none';

        $stmt1 = $db->prepare($query);
        $stmt1->execute([$name]);

        $data = $stmt1->fetch();
        if ($data['name'] == $name) {
            return $data['id'];
        }

        $query = 'INSERT INTO countries (name) value (?);';
        $stmt2 = $db->prepare($query);
        $stmt2->execute([$name]);
        return $this->checkCountry();
    }

    private function convertDate(int $date): string
    {
        return $date . '-01-01';
    }

    private function convertPrice(string $price): int
    {
        $price = trim($price, '$');
        $price = (int) $price;

        $client = new GuzzleHttp\Client();
        $headers = ['Content-Type' => 'text/plain', 'apikey' => 'vgIAGheWd9xztZDUFpQxHwiSgrytJYH6'];
        $options = ['headers' => $headers];
        $uri = "https://api.apilayer.com/fixer/convert?to=RUB&from=USD&amount=$price";
        $data = $client->request('GET', $uri, $options);
        $data = json_decode($data->getBody(), true);

        if (isset($data['result'])) {
            $convertedPrice = (int) $data['result'] ?? 0;
        }

        return $convertedPrice ?? 0;
    }
}
