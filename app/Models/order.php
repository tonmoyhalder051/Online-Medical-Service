<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $table='order';

    protected $fillable = [
        'email',
        'user_id',
        'hospital_id',
        'name',
        'address',
        'age',
        'mobile',
        'gender',
        'blood_group',
        'appointment_date',
        ];
//    public function getStatusAttribute($value){
//        if($value == -1) return '<b><span class="text-error">Cancel</span></b>';
//        if($value == 0) return '<b><span class="text-success">Pending</span></b>';
//        if($value  == 1) return '<b><span class="text-success">Approve</span></b>';
//        if($value == 2) return '<b><span class="text-success">Processing</span></b>';
//        return '<b><span class="text-success">Complete</span></b>';
//    }


    public function getGenderAttribute($value){
        return ucfirst($value);

    }



}
