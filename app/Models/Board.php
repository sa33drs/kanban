<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','creator_id'];

//    public function users(){
//        return $this->belongsToMany(Board::class);
//    }
}
