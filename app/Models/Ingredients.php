<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;
    protected $table = 'ingredients';
    protected $primaryKey='id';
    public $timestamps = true;
    public function ingredient_category(){
        return $this->belongsTo(Ingredient_Categories::class,'category_id');
    }
    protected $fillable =[
        'ingredient_name','category_id'
    ];
}
