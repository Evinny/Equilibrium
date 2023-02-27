<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_emotion extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'emotion_id'];
}
