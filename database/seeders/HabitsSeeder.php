<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Habit;

class HabitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $habits = [
            //basta seguir o modelo para adicionar e remover habitos ou criar novas categorias
                //modelo a seguir: 'habitos_categoria' => ['habito', 'habito', 'habito', 'habito',],
            '🙂Bons' => ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'],
            '😐Neutros' => ['k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 't'],
            '☹️Ruins' => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            //'categoria' => ['exemplo de habito', 'exemplo de habito', 'exemplo de habito',],

        ];
        
        foreach($habits as $habit_category => $names){
            foreach($names as $name){
                Habit::create([
                    'name' => $name,
                    'category' => $habit_category
                ]);
            }
        }
        
    }
}
