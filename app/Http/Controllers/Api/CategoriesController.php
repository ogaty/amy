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
            return ['error' => 'no title', 'message' => 'no title'];
        }
        $categories = new CategoriesService();
        $ret = $categories->addCategory(['name' => $_POST['name']]);
        if (isset($ret['error'])) {
            return ['error' => $ret['error'], 'message' => 'error' . $ret['error']];
        }
        return ['error' => 'success', 'message' => 'success'];
    }

    public function update(Request $request) {
        $categories = new CategoriesService();
        $ret = $categories->updateCategory($request->only(['id', 'name']));
        if (isset($ret['error'])) {
            return ['error' => $ret['error'], 'message' => 'error' . $ret['error']];
        }
        return ['error' => 'success', 'message' => 'success'];
    }

    public function detail($id) {
        $categories = new CategoriesService();
        $detail = $categories->getListDetail($id);
        return ['error' => 'success', 'data' => json_encode($detail)];
    }
}
