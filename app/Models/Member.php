<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['ex_id', 'country', 'title', 'industry', 'email', 'phone', 'fullName', 'position', 'visitor', 'input_1', 'input_2', 'input_3', 'input_4', 'slug', 'entrance_id'];

    public function exhibition(){
        return $this->belongsTo(Exhibition::class, 'ex_id', 'id');
    }

    public function userCountry(){
        return $this->belongsTo(Country::class, 'country', 'code');
    }

    public function userIndustry(){
        return $this->belongsTo(Industry::class, 'industry', 'id');
    }

    public function advertising(){
        return $this->belongsToMany(Advertising::class, 'member_advertising', 'member_id', 'advertising_id');
    }

    public function entrance(){
        return $this->belongsTo(Entrance::class, 'entrance_id', 'id');
    }

}
