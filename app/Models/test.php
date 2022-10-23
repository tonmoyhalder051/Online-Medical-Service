<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class test extends Model
{
    use HasFactory;
    protected $table = 'test';

    protected $fillable = [
        'hospital_id',
        'service_type',
        'name',
        'description',
        'price',
        'discount',
        'active',
    ];
    public static function getserviceTypeAttribute($value){
        if($value=='1') return "Regular";
        return "Home service";
    }

}
