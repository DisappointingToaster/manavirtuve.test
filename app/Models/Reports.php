<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reports extends Model
{
    use HasFactory;
    protected $table='reports';
    protected $primaryKey = 'id';
    protected $fillable =[
        'user_id','report_reason_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function reportReason(){
        return $this->belongsTo(Report_Reason::class,'report_reason_id');
    }
}
