<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeConnection extends Model
{
    use SoftDeletes;

    protected $table = 'type_connections';
    protected $guarded = array('id');
}
