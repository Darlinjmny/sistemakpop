<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['group_id', 'name', 'birthdate', 'position'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}