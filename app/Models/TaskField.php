<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskField extends Model
{
    use HasFactory;
    protected $fillable = ['title','type','board_id'];

    public function metaData()
    {
        return $this->hasMany(TaskMetaData::class , 'task_field_id' , 'id');
    }
}
