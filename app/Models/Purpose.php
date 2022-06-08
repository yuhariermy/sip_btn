<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purpose extends Model
{
    use SoftDeletes;

    protected $table = 'purposes';
    protected $guarded = array('id');

    public function form() {
        return $this->hasMany('\App\Models\CreateRequestForm','location_id','id');
    }
}
