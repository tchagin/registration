<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = ['message'];

    public function members(){
        return $this->belongsToMany(Member::class, 'distribution_members', 'distribution_id', 'member_mail');
    }
}
