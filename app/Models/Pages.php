<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'main_text',
        'bg_image'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
