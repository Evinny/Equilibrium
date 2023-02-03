<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Response extends Model
{
    use HasFactory;

    protected $fillable = ['date_time', 'user_id', 'emotion_id', 'habit_id'];

    public function habits(){
        return $this->belongsto(Habit::class, 'habit_id', 'id');
    }

    public function emotions(){
        return $this->belongsto(Emotions::class, 'emotions_id', 'id');
    }

    public function user(){
        return $this->belongsto(User::class, 'user_id', 'id');
    }
}
