<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $primaryKey='id';
    protected $fillable=[
        'recipe_id',
        'user_id',
        'description'
    ];
    protected function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    protected function recipes(){
        return $this->belongsTo(Recipes::class,'recipe_id');
    }
}
