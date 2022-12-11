<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeSettings extends Model
{
    use HasFactory;

    const FORM = [
        'vertically' => 'vertically',
        'horizontally' => 'horizontally',
    ];

    const STATUS = [
        'on' => 'on',
        'off' => 'off',
    ];

    protected $fillable = ['width', 'height', 'status', 'orientation'];
}
