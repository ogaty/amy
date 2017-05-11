<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Services\CategoriesService;

class CategoriesController extends \App\Http\Controllers\Controller
{
    public function index() {
        $categories = new CategoriesService();
        $categories->getList();
    }
}
