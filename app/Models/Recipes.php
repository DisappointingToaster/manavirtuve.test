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
        'name','tags','description','image_path','promoted','user_id'
    ];
    protected $attributes = array(
        'favourites' => 0,
        'flagged'=>false,
        'promoted'=>false,
        'hidden'=>false
     );
    public function scopeFilter($query, array $filters){
        if($filters['search']??false){
            $query->where('name','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%');
        };
        
        if($filters['category']??false){
            $tags=request('category');
            $query->
                where(function ($query2) use($tags) {
                for ($i = 0; $i < count($tags); $i++){
                      $query2->where('tags', 'like',  '%' . $tags [$i] .'%');
                }
            });
        };
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
