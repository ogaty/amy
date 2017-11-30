<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = ['name', 'list_id', 'completed', 'memo', 'deadline', 'updated_at'];
}
