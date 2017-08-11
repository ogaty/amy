<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded = [
        'user_id',
        'task_id',
    ];
}
