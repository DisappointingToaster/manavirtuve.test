<?php

namespace App\Models;

use App\Models\Ingredients;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient_Categories extends Model
{
    use HasFactory;
    protected $table = 'ingredient_category';
    protected $primaryKey='id';
    public function ingredients(){
        return $this->hasMany(Ingredients::class,'category_id');
    }
}
