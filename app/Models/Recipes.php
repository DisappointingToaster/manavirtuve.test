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
        'name','tags','description','image_path','promoted','user_id','hidden','forcedHidden'
    ];
    protected $attributes = array(
        'favourites' => 0,
        'flagged'=>false,
        'promoted'=>false,
        'hidden'=>true,
        'forcedHidden'=>false
     );
     //this is what actually filters on query request
    public function scopeFilter($query, array $filters){
        if($filters['searchName']??false){
            $query->where('name','like','%'.request('searchName').'%')
            ->orWhere('description','like','%'.request('searchName').'%');
        };
        
        if($filters['category']??false){
            $tags=request('category');
            $query->
                where(function ($query2) use($tags) {
                for ($i = 0; $i < count($tags); $i++){
                      $query2->where('tags', 'like',  '%' . $tags [$i] .'%');
                }
            });
            if($filters['searchName']??false){
                $query->where('name','like','%'.request('searchName').'%')
                ->orWhere('description','like','%'.request('searchName').'%');
            }
        };
    }
    //setting relationships
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function comments(){
        return $this->hasMany(Comments::class,'recipe_id');
    }
}
