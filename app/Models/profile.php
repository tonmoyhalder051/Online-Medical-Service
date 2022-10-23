<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $table = 'profile';

    protected $fillable = [
        'user_id',
        'hospital_id',
        'blood_group',
        'address',
        'gender',
        'mobile',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function  getRoleAttribute($value){
        switch($value){
            case 1: return "Hospital";
              break;
            case 2: return "OneStop";
                break;
            case 3: return "Lab User";
                break;
            default:  return "User";

         }

     }

}
