<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Services\TasksService;

use Illuminate\Support\Facades\Log;

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
        $data = [
            'name' => $_POST['name'],
            'list_id' => $_POST['list_id'],
        ];
        $tasks= new TasksService();
        return $tasks->addTask($data);
    }

    public function update() {
        Log::debug($_POST);

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
        Log::debug($_POST);

        $data = [
             'id' => $_POST['task']['id'],
             'completed' => $_POST['task']['completed'],
        ];
        $tasks= new TasksService();
        return $tasks->updateTask($data);
    }
}
