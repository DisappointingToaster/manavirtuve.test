<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_Reason extends Model
{
    use HasFactory;
    protected $table='report_reasons';
    protected $primaryKey = 'id';
    protected $fillable =[
        'report_reason'
    ];
    public function reports(){
        return $this->hasMany(Reports::class,'report_reason_id');
    }
}
