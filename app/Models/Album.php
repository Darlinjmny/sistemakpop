<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'title', 'release_date'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}