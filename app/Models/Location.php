<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Location extends Model
{
    use SoftDeletes;

    protected $table = 'locations';
    protected $guarded = array('id');

    public function form() {
        return $this->hasMany('\App\Models\CreateRequestForm','location_id','id');
    }
}
