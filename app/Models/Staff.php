<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff'; // explicitly specify table name 'staff'

    protected $fillable = [
        'name',
        'role',
        'affiliation',
        'expertise',
        'image',
        'email',
        'linkedin',
    ];
}
