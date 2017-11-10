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

    public function update() {
        $data = [
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'memo' => $_POST['memo'],
            'deadline' => $_POST['deadline'],
        ];
        $tasks= new TasksService();
        return $tasks->updateTask($data);
    }

    public function complete() {
        $data = $_POST['task'];
        $tasks= new TasksService();
        return $tasks->updateTask($data);
    }
}
