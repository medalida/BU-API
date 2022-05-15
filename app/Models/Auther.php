<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auther extends Model
{
    use HasFactory;

    protected $primaryKey = 'auther_id';
    protected $fillable = [
        'name',
        'gender',
        'nation',
        'birthday',
        'resume',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
}
