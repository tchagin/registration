<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Exhibition extends Model
{
    const STATUS = [
        'active' => 'active',
        'disable' => 'disable',
    ];
    use HasFactory;

    protected $fillable = ['title', 'logo', 'dateStart', 'dateFinish', 'link', 'status'];

    public function form(){
        return $this->belongsToMany(Form::class, 'exhibition_forms', 'exhibition_id', 'form_id');
    }
//    public function forms()
//    {
//        return $this->belongsToMany(Form::class)->withTimestamps();
//    }

    public function members(){
        return $this->hasMany(Member::class, 'ex_id', 'id');
    }

    public function industry(){
//        return $this->belongsToMany(Exhibition::class, 'exhibition_industries', 'industry_id', 'exhibition_id');
        return $this->belongsToMany(Industry::class, 'exhibition_industries', 'exhibition_id', 'industry_id');
    }


    public static function uploadImage(Request $request, $image = null)
    {
        if ($request->hasFile('logo')) {
            if ($image) {
                Storage::delete($image);
            }
            $folder = date('Y-m-d');
            return $request->file('logo')->store("images/{$folder}");
        }
        return null;
    }

    public function getImage()
    {
        if (!$this->logo) {
            return asset("no-image.png");
        }
        return asset("uploads/{$this->logo}");
    }

    public function getStatus(){
        if ($this->status == 'active'){
            return 'Действующий';
        }else{
            return 'Блокированный';
        }
    }

    public function dateStart() {
        return \Carbon\Carbon::parse($this->dateStart)->format('d-m-Y');
    }
    public function dateFinish() {
        return \Carbon\Carbon::parse($this->dateFinish)->format('d-m-Y');
    }
}
