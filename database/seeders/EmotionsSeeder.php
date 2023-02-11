<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Emotion;
class EmotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $Emotions = [
            'Não sei definir', 'Calmo', 'Ansioso', 'Inspirado', 'Animado', 'Irritado', 'Estressado', 'Esperançoso'
        ];


        foreach($Emotions as $emotion){
            Emotion::create([
                'emotion' => $emotion,
            ]);
        }



    }
}
