<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_service extends Model
{
    use HasFactory;
    protected $table = 'order_service';

    protected $fillable = [
        'order_id',
        'service_id',

    ];
    public static function getserviceTypeAttribute($value){
        if($value=='1') return "Regular";
        return "Home service";
    }



}
