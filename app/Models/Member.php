<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name',
        'nickname',
        'role',
        'avatar',
        'gender',
        'birth_date',
    ];
}
