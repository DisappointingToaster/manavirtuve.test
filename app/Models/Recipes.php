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
        'name','tags','description','image_path','promoted'
    ];
    protected $attributes = array(
        'favourites' => 0,
        'flagged'=>false,
        'promoted'=>false,
        'hidden'=>false
     );
}
