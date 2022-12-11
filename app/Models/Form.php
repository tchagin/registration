<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    use LocalizableModel;

    const STATUS = [
        'active' => 'active',
        'disable' => 'disable',
    ];

//    protected $guarded = [];
    protected $fillable = ['status'];

    public function exhibition(){
        return $this->belongsToMany(Exhibition::class, 'exhibition_forms', 'form_id', 'exhibition_id');
    }

    public function getStatus(){
        if($this->status == 'active'){
            return 'Активный';
        }elseif ($this->status == 'disable'){
            return 'Неактивный';
        }
    }
}
