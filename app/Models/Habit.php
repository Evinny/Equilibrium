<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'categoria'];

    public function response(){
        return $this->hasmany(Response::class, 'habit_id', 'id');
    }
}
