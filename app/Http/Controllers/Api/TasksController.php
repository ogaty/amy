<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Services\TasksService;

class TasksController extends \App\Http\Controllers\Controller
{
    //
    public function index() {
        $tasks = new TasksService();
        return $tasks->getList(0);
    }

    public function lists($id) {
        $tasks = new TasksService();
        return $tasks->getList($id);
    }

    public function add() {
        $data = $_POST['task'];
        $tasks= new TasksService();
        return $tasks->addTask($data);
    }
}
