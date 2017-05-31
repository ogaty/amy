<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Services\TasksService;

class TasksController extends \App\Http\Controllers\Controller
{
    //
    public function index() {
        $categories = new TasksService();
        return $categories->getList(0);
    }
}
