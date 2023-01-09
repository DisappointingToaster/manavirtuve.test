<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;
    protected $table = 'kitchen';
    protected $primaryKey = 'id';
    protected $fillable =[
        'recipe_id','user_id'
    ];
    public function recipes(){
        return $this->belongsTo(Recipes::class, 'recipe_id');
    }
}
