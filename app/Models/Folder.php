<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    // Добавьте здесь поля для массового присвоения
    protected $fillable = [
        'name',
        'user_id',
        'parent_id',
    ];
}