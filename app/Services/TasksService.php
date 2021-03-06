<?php
namespace App\Services;

use \App\Services\BaseService;
use \App\Eloquent\Tasks;

use Illuminate\Support\Facades\Log;

class TasksService extends BaseService {

    public $tasks;

    public function __construct() {
        $this->tasks = new Tasks();

    }

    public function getList($list_id) {
        $task_lists = $this->tasks->where('list_id', $list_id)->where('completed', 0)->get();
        return $task_lists->toArray();
    }

    public function getCompletedList($list_id) {
        $task_lists = $this->tasks->where('list_id', $list_id)->where('completed', 1)->get();
        return $task_lists->toArray();
    }

    public function getTask($id) {
        $task_detail = $this->tasks->where('id', $id)->get();
        return $task_detail->first()->toArray();
    }

    public function addTask($data) {
//        $data = $request->input('request');

/*
        $this->tasks->name = $data['name'];
        $this->tasks->completed = 0;
        $this->tasks->list_id = $data['list_id'];
        $this->tasks->save($data);
*/
        return $this->tasks::create($data);
    }

    public function removeTask() {
        $data = $request->input('request');

        $this->tasks->where('id', $data['id'])->delete();
        return $this->tasks->toArray();
    }

    public function updateTask($data) {
//        $data = $request->input('request');

        Log::debug(var_export($data, true));

        $tasks = $this->tasks->find($data['id']);
        if (isset($data['name'])) {
            $tasks->name = $data['name'];
        }
        if (isset($data['completed'])) {
            $tasks->completed = $data['completed'];
        }
        if (isset($data['list_id'])) {
            $tasks->list_id = $data['list_id'];
        }
        if (isset($data['memo'])) {
            $tasks->memo = $data['memo'];
        }
        if (isset($data['deadline'])) {
            if ($data['deadline'] != "null") {
                $tasks->deadline = $data['deadline'];
            }
        }
        if (isset($data['star'])) {
            $tasks->star = $data['star'];
        }
        $tasks->update();
        return $tasks->toArray();
    }
}
