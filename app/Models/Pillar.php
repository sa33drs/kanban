<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pillar extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','order','position','board_id'];

    public function board(){
        return $this->belongsTo(Board::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
