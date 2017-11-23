<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \App\Eloquent\UsersToken;
use App\Services\TasksService;
use \App\Services\CategoriesService;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userModel = new User();
        $user = $userModel->where('id', Auth::id())->first();
        $categoriesService = new CategoriesService();
        $categories = $categoriesService->getList();
        $tasksService = new TasksService();
        $tasks = $tasksService->getList(1);
        $completedTasks = $tasksService->getCompletedList(1);

        return view('home', [
            'user' => $user,
            'categories' => $categories,
            'tasks' => $tasks,
            'completed_tasks' => $completedTasks,
            'detail' => [
                'id' => '',
                'name' => '',
                'memo' => '',
                'deadline' => ''
            ] 
        ]);
    }
}
