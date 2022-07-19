<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMetaData extends Model
{
    use HasFactory;

    protected $fillable = ['task_field_id','task_id','value'];
    protected $table = 'task_meta_data';
}
