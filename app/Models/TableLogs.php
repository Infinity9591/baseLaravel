<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableLogs extends Model
{
    protected $table = 'table_log';
    public $timestamps = false;

    protected $primaryKey = 'table_name';

    protected $casts = [
        'table_name' => 'string',
    ];
    protected  $fillable = [
        'table_name',
    ];


}
