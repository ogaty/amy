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
        return array();
    }
}
