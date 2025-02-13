<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'permission';
    public $timestamps = false;
    protected $fillable = [
        'action_name',
    ];
}
