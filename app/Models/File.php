<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'user_id',
        'folder_id',
    ];

    // Определение отношения "принадлежит"
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    // Также можно определить отношение с пользователем (если это необходимо)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
