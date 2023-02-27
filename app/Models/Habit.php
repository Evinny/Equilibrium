<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function responses(){
        return $this->hasmany(Response::class, 'habit_id', 'id');
    }

    public function users(){
        return $this->belongstomany(User::class, 'user_habits');
    }

}
