<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $models = Notification::where('is_role', Auth::user()->is_role)->latest()->get();

            return datatables()->of($models)
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.notification.index');
    }
}
