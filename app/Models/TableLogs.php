<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableLogs extends Model
{
    protected $table = 'able_log';
    public $timestamps = false;

    protected $primaryKey = 'table_name';


}
