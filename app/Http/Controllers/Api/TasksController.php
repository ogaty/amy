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

    public function add(Request $request) {
        $tasks= new TasksService();
        return $tasks->addTask($request->only(['name', 'list_id']);
    }

    public function update(Request $request) {
//        Log::debug($_POST);

        $data = [
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'memo' => $request->input('memo'),
            'deadline' => $request->input('deadline'),
        ];
        $tasks= new TasksService();
        return $tasks->updateTask($data);
    }

    public function complete(Request $request) {

        $data = [
             'id' => $request->input('task.id'),
             'completed' => $request->input('task.completed'),
        ];
        $tasks= new TasksService();
        return $tasks->updateTask($data);
    }
}
