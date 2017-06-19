<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Services\CategoriesService;

use Illuminate\Support\Facades\Log;

class CategoriesController extends \App\Http\Controllers\Controller
{
    public function index() {
        $categories = new CategoriesService();
        return $categories->getList();
    }

    public function add() {
        Log::info(var_export($_POST, true));
        if (strlen($_POST['name']) == 0) {
            return ['error' => 100, 'message' => 'no title'];
        }
        $categories = new CategoriesService();
        $ret = $categories->addCategory(['name' => $_POST['name']]);
        if (isset($ret['error'])) {
            return ['error' => $ret['error'], 'message' => 'error' . $ret['error']];
        }
        return ['error' => 0, 'message' => 'success'];
    }
}
