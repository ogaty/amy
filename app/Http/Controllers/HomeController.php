<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use \App\Eloquent\UsersToken;
use App\Services\TasksService;
use \App\Services\CategoriesService;

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
        $token = new UsersToken();
        $user = $token->where('user_id', Auth::id())->first();
        if (is_null($user)) {
            $random = Str::random();
            $token->user_id = Auth::id();
            $token->token = $random;
            $token->save();
        } else {
            $random = $user->token;
        }
        $categoriesService = new CategoriesService();
        $categories = $categoriesService->getList();
        $tasksService = new TasksService();
        $tasks = $tasksService->getList(1);
        $completedTasks = $tasksService->getCompletedList(1);

        return view('home', [
            'token' => [
                'id' => $user->id,
                'token' => $user->token,
                'user_id' => $user->user_id
            ],
            'categories' => $categories,
            'tasks' => $tasks,
            'completed_tasks' => $completedTasks
        ]);
    }
}
