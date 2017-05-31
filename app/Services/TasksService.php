<?php
namespace App\Services;

use \App\Services\BaseService;
use \App\Eloquent\Tasks;

class TasksService extends BaseService {

    public $tasks;

    public function __construct() {
        $this->tasks = new Tasks();

    }

    public function getList($list_id) {
        $task_lists = $this->tasks->where('list_id', $list_id)->get();
        return $task_lists;
    }

    public function addTask() {
        $data = $request->input('request');

        $this->tasks->name = $data['name'];
        $this->tasks->completed = 0;
        $this->tasks->list_id = $data['list_id'];
        $this->tasks->save($data);
        return;
    }
}
