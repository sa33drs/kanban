<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','color','order','pillar_id'];

    public function pillar(){
        return $this->belongsTo(Pillar::class);
    }
    public function fields(){
        return $this->belongsToMany(TaskField::class,'task_meta_data','task_id','task_field_id')->withPivot('value');
    }
}
