<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
    ];

    protected $casts = [
        'id' => 'string',
    ];

    public function account(){
        return $this->belongsTo(Accounts::class, 'account_id');
    }
}
