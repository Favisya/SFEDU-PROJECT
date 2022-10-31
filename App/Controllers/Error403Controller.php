<?php

namespace App\Controllers;

class Error403Controller extends AbstractController
{
    public function execute()
    {
        $this->renderPage('403');
    }
}
