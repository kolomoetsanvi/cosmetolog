<?php

namespace App\Repositories;

use App\View;

class ViewsRepository extends Repository{

    public function __construct(View $view )
    {
        $this->model = $view;
    }
}

