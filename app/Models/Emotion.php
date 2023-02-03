<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;

    protected $fillable = ['emotion'];

    public function response(){
        return $this->hasmany(Response::class, 'Emotion_id', 'id');
    }

    public function users(){
        return $this->belongstomany(User::class, 'user_habits');
    }

}
