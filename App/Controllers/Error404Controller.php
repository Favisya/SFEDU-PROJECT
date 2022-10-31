<?php

namespace App\Controllers;

class Error404Controller extends AbstractController
{
    public function execute()
    {
        $this->renderPage('404');
    }
}
