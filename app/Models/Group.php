<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'debut_date',
        'company',
        'image_url', // Añadir este campo
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
