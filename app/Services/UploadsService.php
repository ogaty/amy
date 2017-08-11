<?php
namespace App\Services;

use \App\Services\BaseService;
use \App\Eloquent\Uploads;

class UploadsService extends BaseService {

    public $uploads;

    public function __construct() {
        $this->uploads = new Uploads();

    }

    public import() {

    }
}
