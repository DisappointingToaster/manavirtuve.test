<?php

namespace Database\Seeders;

use App\Models\Ingredient_Categories;
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
        Ingredient_Categories::create([
            'category_name'=>'Meat'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Fruit'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Liquid'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Egg'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Grain'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Complimentary'
        ]);
        Ingredient_Categories::create([
            'category_name'=>'Beverage'
        ]);
        Ingredients::create([
            'ingredient_name'=>'egg',
            'category_id'=>4
        ]);
        Ingredients::create([
            'ingredient_name'=>'bacon',
            'category_id'=>1
        ]);
        Ingredients::create([
            'ingredient_name'=>'bread',
            'category_id'=>5
        ]);
        Ingredients::create([
            'ingredient_name'=>'sausage',
            'category_id'=>4
        ]);
        Ingredients::create([
            'ingredient_name'=>'water',
            'category_id'=>7
        ]);
        Ingredients::create([
            'ingredient_name'=>'salt',
            'category_id'=>6
        ]);
    }
}