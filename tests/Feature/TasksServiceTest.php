<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Services\TasksService;

class TasksServiceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetList()
    {
        $tasks = new TasksService();
        $lists = $tasks->getList(1);
        $this->assertNotEmpty($lists);
        $this->assertNotEmpty($lists[0]['name']);
        $cnt = count($lists);
        $data = ['id' => $lists[0]['id'], 'completed' => 1];
        $detail = $tasks->updateTask($data);
        $lists = $tasks->getList(1);
        $cnt2 = count($lists);
        $this->assertEquals($cnt2, $cnt - 1);
        $lists = $tasks->getList(-1);
        $this->assertEmpty($lists);
    }

    public function testGetTask()
    {
        $tasks = new TasksService();
        $lists = $tasks->getTask(1);
        $this->assertTrue(true);
    }

    public function testAddTask()
    {
        $tasks = new TasksService();
        $newTask = $tasks->addTask(['name' => 'newTask', 'list_id' => 0]);
        $detail = $tasks->getTask($newTask->id);
        $this->assertEquals($detail['list_id'], 0);

        $newTask = $tasks->addTask(['name' => 'newTask', 'list_id' => 1]);
        $detail = $tasks->getTask($newTask->id);
        $this->assertEquals($detail['list_id'], 1);
    }

    public function testUpdateTask()
    {
        $tasks = new TasksService();
        $newTask = $tasks->addTask(['name' => 'updateTask1', 'list_id' => 0]);
        $detail = $tasks->getTask($newTask['id']);
        $data = ['id' => $detail['id'], 'name' => 'updateTask2'];
        $detail = $tasks->updateTask($data);
        $this->assertEquals($detail['name'], 'updateTask2');
        $data = ['id' => $detail['id'], 'completed' => 1];
        $detail = $tasks->updateTask($data);
        $this->assertEquals($detail['completed'], 1);
        $data = ['id' => $detail['id'], 'star' => 1];
        $detail = $tasks->updateTask($data);
        $this->assertEquals($detail['star'], 1);
    }
}
