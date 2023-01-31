<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Input extends Model
{
    use HasFactory;

    public function habito(){
        return $this->belongsto(Habito::class, 'habito_id', 'id');
    }

    public function sentimento(){
        return $this->belongsto(Sentimento::class, 'sentimento_id', 'id');
    }

    public function user(){
        return $this->belongsto(User::class, 'user_id', 'id');
    }
}
