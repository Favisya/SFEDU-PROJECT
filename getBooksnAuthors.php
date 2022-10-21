#!/usr/bin/php
<?php

require_once 'vendor/autoload.php';

define('APP_ROOT', dirname(__FILE__));

$booksResource = new \App\Models\Resource\BooksResource();
$booksModel = $booksResource->getBooks();

$time = new DateTime();
$date = date('d_m_o__H_i', $time->getTimestamp());
$stream = fopen(APP_ROOT . '/var/output/books_authors_' . $date  . '.csv', 'w+');

$data = [];

foreach ($booksModel->getList() as $book) {
    $data = [
            'id'        => $book->getId(),
            'name'      => $book->getName(),
            'price'     => $book->getPrice(),
            'author'    => $book->getAuthor(),
            'publisher' => $book->getPublisher(),
            'date'      => $book->getYear(),
            'country'   => $book->getCountry(),
        ];
    fputcsv($stream, $data);
}
fclose($stream);


