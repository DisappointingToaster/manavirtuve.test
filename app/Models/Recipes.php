<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipes extends Model
{
    use HasFactory;
    protected $table = 'recipe';
    protected $primaryKey = 'id';
    protected $fillable =[
        'name','tags','description'
    ];
    protected $attributes = array(
        'favourites' => 0,
     );
}
