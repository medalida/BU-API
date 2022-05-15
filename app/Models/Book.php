<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'book_id';
    protected $fillable = [
        'title',
        'year',
        'type',
        'resume',
        'image',
        'auther_id',
];
protected $hidden = [
    'created_at',
    'updated_at',

];
}
