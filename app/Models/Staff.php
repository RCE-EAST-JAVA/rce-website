<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff'; // explicitly specify table name 'staff'

    protected $fillable = [
        'name',
        'role',
        'category',
        'expertise',
        'description',
        'image',
        'email',
        'linkedin',
        'sort_order',
    ];
}
