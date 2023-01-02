<?php

namespace Database\Seeders;

use App\Models\Ingredients;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Ingredients::create([
            'ingredient_name'=>'egg',
            'ingredient_type'=>'fridge'
        ]);
        Ingredients::create([
            'ingredient_name'=>'bacon',
            'ingredient_type'=>'meat'
        ]);
        Ingredients::create([
            'ingredient_name'=>'bread',
            'ingredient_type'=>'wheat'
        ]);
        Ingredients::create([
            'ingredient_name'=>'sausage',
            'ingredient_type'=>'meat'
        ]);
        Ingredients::create([
            'ingredient_name'=>'water',
            'ingredient_type'=>'liquid'
        ]);
        Ingredients::create([
            'ingredient_name'=>'salt',
            'ingredient_type'=>'additive'
        ]);
    }
}