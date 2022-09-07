<?php

namespace App\Controllers;

use App\Blocks\CreateLibraryBlock;
use App\Database\Database;

class CreateLibraryController implements ControllerInterface
{
    public function execute()
    {
        $block = new CreateLibraryBlock();

        if (REQUEST_METHOD == 'GET') {
            $block->render();
        } else {
            $this->createLibrary();
        }
    }

    private function createLibrary()
    {
        if (!isset($_POST['libName'], $_POST['libAddress'])) {
            return false;
        }

        $libName     = htmlspecialchars($_POST['libName']);
        $libAddress  = htmlspecialchars($_POST['libAddress']);

        $db   = Database::getInstance();
        $stmt = $db->connectDB();

        $query = 'INSERT INTO libraries (name, address) values (?, ?)';

        $stmtFirst = $stmt->prepare($query);
        $stmtFirst->execute([$libName, $libAddress]);

        $query      = 'SELECT id FROM libraries WHERE name = ? AND address = ?;';
        $stmtSecond = $stmt->prepare($query);
        $stmtSecond->execute([$libName, $libAddress]);

        $id = $stmtSecond->fetch()['id'];

        header("Location: http://localhost:3000/library?id=$id");
        return true;
    }
}
