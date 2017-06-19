<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use \App\Service\UploadService;
use \App\Eloquent\Tasks;

use Illuminate\Support\Facades\Log;

class UploadsController extends \App\Http\Controllers\Controller
{
    //
    public function import() {

        if (is_null($_FILES)) {
            return ['message' => '$_FILES is empty.'];
        }
        $files = $_FILES['import']['tmp_name'];

        if (is_null($files) || !file_exists($files)) {
            return ['message' => 'file not found.'];
        }

        $data = file_get_contents($files);

        $inputs = explode("\n", $data);

        foreach ($inputs as $value) {
            $this->tasks = new Tasks();
            $this->tasks->name = $value;
            $this->tasks->list_id = 0; //
            $this->tasks->completed = 0; //
            $this->tasks->save();
        }

        return ['message' => 'success'];
    }
}
