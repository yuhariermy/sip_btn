<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailConnection extends Model
{
    use SoftDeletes;

    protected $table = 'detail_requests';
    protected $guarded = array('id');

    public function type_connection() {
        return $this->belongsTo('\App\Models\TypeConnection','connection_type_id','id');
    }
}
