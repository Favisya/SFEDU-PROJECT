<?php

namespace App\Core\Controllers;

class Error403Controller extends AbstractController
{
    public function execute()
    {
        $this->renderPage('403', $this->block);
    }
}
