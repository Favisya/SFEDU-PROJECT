<?php

namespace App\Controllers;

use App\Blocks\CreateAuthorBlock;
use App\Database\Database;

class CreateAuthorController implements ControllerInterface
{
    public function execute()
    {
        $block = new CreateAuthorBlock();

        if (REQUEST_METHOD == 'GET') {
            $block->render();
        } else {
            $this->createAuthor();
        }
    }

    private function createAuthor()
    {
        $authorName  = htmlspecialchars($_POST['authorName']);

        $db   = Database::getInstance();
        $stmt = $db->connectDB();

        $query = 'INSERT INTO authors (name) values (?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$authorName]);

        $query      = 'SELECT id FROM authors WHERE name = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$authorName]);

        $id = null;
        while ($row = $stmtSecond->fetch()) {
            $id = $row['id'];
        }

        header("Location: http://localhost:3000/author?id=$id");
    }
}
