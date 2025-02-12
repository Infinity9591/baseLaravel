<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    protected $table = 'account';
    public $timestamps = false;
    protected $fillable = [
        'username',
        'password_hash',
        'is_active'
    ];

    public function role(){
        return $this->belongsTo(Roles::class);
    }
}
