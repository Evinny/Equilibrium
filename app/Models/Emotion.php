<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emotion extends Model
{
    use HasFactory;


    public function response(){
        return $this->hasmany(Response::class, 'Emotion_id', 'id');
    }
}
