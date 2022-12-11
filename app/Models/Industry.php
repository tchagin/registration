<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use LocalizableModel;

    protected $fillable = ['title'];

    use HasFactory;

    public function exhibitions(){
        return $this->belongsToMany(Exhibition::class, 'exhibition_industries', 'industry_id', 'exhibition_id');
    }

}
