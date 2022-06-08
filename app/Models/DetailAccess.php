<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailAccess extends Model
{
    use SoftDeletes;

    protected $table = 'detail_accesses';
    protected $guarded = array('id');

    public function type_access() {
        return $this->belongsTo('\App\Models\TypeAccess','access_type_id','id');
    }
}
