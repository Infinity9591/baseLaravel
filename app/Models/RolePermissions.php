<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermissions extends Model
{
    protected $table = 'role_permission';
    public $timestamps = false;
    protected $fillable = [
        'table_name',
        'password_hash',
        'is_active',
        'role_id',
        'permission_id',
    ];

    public function role(){
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }

    public function permission(){
        return $this->belongsTo(Permissions::class, 'permission_id', 'id');
    }

    public function tablelog(){
        return $this->belongsTo(TableLogs::class, 'table_name', 'table_name');
    }
}
