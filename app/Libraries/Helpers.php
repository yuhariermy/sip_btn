<?php
namespace App\Libraries;
use DB;
Class Helpers {
    public static function role($role = null) {
        if($role == 1) {
            $role = 'Admin';
        } else if ($role == 2) {
            $role = 'Staff';
        } else if ($role == 3) {
            $role = 'Opr Change Management a.k.a CMT';
        } else if ($role == 4) {
            $role = 'Quality Assurance a.k.a QA';
        } else if ($role == 5) {
            $role = 'IT Secruity';
        } else {
            $role = '-';
        }

        return $role;
    }

    //Maksd dari fungsi ini
    public static function autonumber($barang, $primary, $prefix)
    {
        $no = self::checkNumber($barang);
        return "$no/CRF/ITOD/OCMD/".date('m').'/'.date('Y');
    }

    public static function checkNumber($barang)
    {
        $no_surat = DB::table($barang)
            ->where("no_surat", "<>", null)
            ->count() + 1;

        if(strlen($no_surat) == 1) {
            $no = '00' . $no_surat;
        } elseif(strlen($no_surat) == 2) {
            $no = '0' . $no_surat;
        } else {
            $no = $no_surat;
        }

        return $no;
    }

    public static function notification($role, $message, $is_read = 0) {
        $log            = [];
        $log['is_role'] = $role;
        $log['message'] = $message;
        $log['is_read'] = $is_read;
        \App\Models\Notification::create($log);
    }
}
