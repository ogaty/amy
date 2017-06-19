<?php
namespace App\Services;

use \App\Services\BaseService;
use \App\Eloquent\Categories;

class CategoriesService extends BaseService {

    public $categories;

    public function __construct() {
        $this->categories = new Categories();

    }

    public function getList() {
        $list_lists = $this->categories->get();
        return $list_lists->toArray();
    }

    public function getListDetail($id) {
        $detail = $this->categories->where('id', $id)->get();
        return $detail->first()->toArray();
    }

    public function addCategory($data) {
//        $data = $request->input('request');
        if (!is_array($data)) {
            return ['error' => 1];
        }
        if (!isset($data['name'])) {
            return ['error' => 2];
        }
        if (strlen($data['name']) == 0) {
            return ['error' => 3];
        }

        $this->categories->name = $data['name'];
        $this->categories->save();
        return $this->categories->toArray();
    }

    public function removeCategory($data) {
//        $data = $request->input('request');

        $this->categories->where('id', $data['id'])->delete();
        return $this->categories->toArray();
    }

    public function updateCategory($data) {
//        $data = $request->input('request');

        $this->categories->id = $data['id'];
        $this->categories->name = $data['name'];
        $this->categories->save($data);
        return $this->categories->toArray();
    }

}
