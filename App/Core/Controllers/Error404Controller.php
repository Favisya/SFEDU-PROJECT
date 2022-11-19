<?php

namespace App\Core\Controllers;

class Error404Controller extends AbstractController
{
    public function execute()
    {
        $this->renderPage('404', $this->block);
    }
}
