<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeAccess extends Model
{
    use SoftDeletes;

    protected $table = 'type_acesses';
    protected $guarded = array('id');
}
