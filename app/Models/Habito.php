<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'categoria'];

    public function input(){
        return $this->hasmany(Input::class, 'habito_id', 'id');
    }
}
