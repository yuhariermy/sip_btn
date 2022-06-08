<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Alfa6661\AutoNumber\AutoNumberTrait;

class CreateRequestForm extends Model
{
    use SoftDeletes;
    // use AutoNumberTrait;

    protected $table = 'create_request_forms';
    protected $guarded = array('id');

    public function user() {
        return $this->belongsTo('\App\Models\User','user_id','id');
    }
    
    public function purpose() {
        return $this->belongsTo('\App\Models\Purpose','purpose_id','id');
    }

    public function location() {
        return $this->belongsTo('\App\Models\Location','location_id','id');
    }

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    // public function getAutoNumberOptions()
    // {
    //     return [
    //         'no_surat' => [
    //             'format' => function () {
    //                 return '?/CRF/ITOD/OCMD/'.date('m').'/'.date('Y'); // autonumber format. '?' will be replaced with the generated number.
    //             },
    //             'length' => 3 // The number of digits in the autonumber
    //         ]
    //     ];
    // }


}
