<?php

namespace App\Controllers\Console;

use App\Models\Resource\Environment;
use App\Models\Resource\UpdateBooksResource;
use App\Models\SessionModel;
use App\Models\TokenModel;
use GuzzleHttp;

class NewBooksController extends AbstractController
{
    public function __construct(
        SessionModel $session,
        TokenModel $tokenModel,
        Environment $environment,
        UpdateBooksResource $resource
    ) {
        parent::__construct($session, $tokenModel, $environment, $resource);
    }

    public function execute()
    {
        $this->resource->parseNewBooks();
    }
}
