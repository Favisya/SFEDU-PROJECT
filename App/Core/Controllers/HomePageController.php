<?php

namespace App\Core\Controllers;

class HomePageController extends AbstractController
{
    public function execute()
    {
        $this->renderPage('homepage', $this->block);
    }
}
