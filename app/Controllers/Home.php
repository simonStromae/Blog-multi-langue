<?php

namespace App\Controllers;

use App\Models\RecipeModel;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->route("posts", ['fr']);
    }
}
