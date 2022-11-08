<?php

namespace App\Controllers;

class HomePageController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('homepage');
    }
}
