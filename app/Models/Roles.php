<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'role';
    public $timestamps = false;
    protected $fillable = [
        'name',
    ];
}
