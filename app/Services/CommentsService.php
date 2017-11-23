<?php
namespace App\Services;

use \App\Services\BaseService;
use \App\Eloquent\Comments;

class CommentsService extends BaseService {

    public $comments;

    public function __construct() {
        $this->comments = new Comments();

    }

    public function getLists() {
        return $this->comments->all();
    }
}
