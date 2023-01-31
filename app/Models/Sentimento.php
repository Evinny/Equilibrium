<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentimento extends Model
{
    use HasFactory;


    public function input(){
        return $this->hasmany(Input::class, 'sentimento_id', 'id');
    }
}
