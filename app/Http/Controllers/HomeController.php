<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CreateRequestForm;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getDashboardData($type = 'all')
    {
        $data = CreateRequestForm::whereNotNull('no_surat');

        switch ($type) {
            case 'done':
                $data->where('ttd_it', '>', 0);
                break;

            case 'process':
                $data->where('ttd_it', null);
                break;

            case 'month':
                $data->whereMonth('created_at', now()->format('m'));
                break;
        }

        $sum = $data->count();

        return $sum;
    }

    public function getDashboardHighlight()
    {
        $models = CreateRequestForm::with('user', 'purpose', 'location')
            ->whereNull('ttd_it')
            ->whereNotNull('no_surat')
            ->orderBy('send_at', 'ASC')
            ->get();

        if (Auth::User()->is_role == 1 || Auth::User()->is_role == 2) {
            if (request()->ajax()) {
                return datatables()->of($models)
                ->addIndexColumn()
                ->editColumn('purpose.name', function ($models) {
                    if ($models->purpose_id == null) {
                        $model = '-';
                    } else {
                        $model = $models->purpose['name'];
                    }

                    return $model;
                })
                ->editColumn('purpose_other', function ($models) {
                    return (empty($models->purpose_other) ? '-' : $models->purpose_other);
                })
                ->editColumn('user.name', function ($models) {
                    if ($models->user_id == null) {
                        $model = '-';
                    } else {
                        $model = $models->user['name'];
                    }

                    return $model;
                })
                ->editColumn('location.name', function ($models) {
                    if ($models->location_id == null) {
                        $model = '-';
                    } else {
                        $model = $models->location['name'];
                    }

                    return $model;
                })
                ->editColumn('start_date', function ($models) {
                    return Carbon::parse($models->start_date)->isoFormat('dddd, D MMMM Y');
                })
                ->editColumn('end_date', function ($models) {
                    if ($models->end_date == null) {
                        $end_date = '<img src="' . asset('assets/infinite.png') . '" width="18" />';
                    } else {
                        $end_date = Carbon::parse($models->end_date)->isoFormat('dddd, D MMMM Y');
                    }

                    return $end_date;
                })
                ->editColumn('ttd_requester', function ($models) {
                    return $models->ttd_requester ?
                    '<img src="'. asset('assets/checked.png') .'" width="18">' :
                    null;
                })
                ->editColumn('ttd_cmt', function ($models) {
                    return $models->ttd_cmt ?
                    '<img src="'. asset('assets/checked.png') .'" width="18">' :
                    null;
                })
                ->editColumn('ttd_qa', function ($models) {
                    return $models->ttd_qa ?
                    '<img src="'. asset('assets/checked.png') .'" width="18">' :
                    null;
                })
                ->editColumn('ttd_it', function ($models) {
                    return $models->ttd_it ?
                    '<img src="'. asset('assets/checked.png') .'" width="18">' :
                    null;
                })
                ->addColumn('status_kirim', function ($models) {
                    if ($models->is_kirim == 1) {
                        $label  = "label label-lg label-success label-inline";
                        $status = "Terkirim";
                    } else {
                        $label  = "label label-lg label-info label-inline p-5";
                        $status = "Belum Terkirim";
                    }

                    return '<span class="label ' . $label . '">' . $status . '</span>';
                })
                ->addColumn('kirim', function ($models) {
                    if ($models->is_kirim == 1) {
                        $button = '';
                    } else {
                        $button = '<div class="d-flex">';
                        $button .= '<div class="mr-1">';
                        $button .= '<button type="button" class="send btn btn-sm btn-primary text-center" data-id="' . $models->id . '"> <i class="m-0 p-0 fa fa-paper-plane"></i> Kirim</button>';
                        $button .= '</div>';
                        $button .= '</div>';
                    }

                    return $button;
                })
                ->addColumn('print', function ($models) {
                    $button = '<div class="d-flex">';
                    $button .= '<div class="mr-1">';
                    $button .= '<a href="'.route('create_request_form.print', $models->id).'" class="btn btn-sm btn-danger text-center"> <i class="m-0 p-0 fa fa-print"></i> Cetak</a>';
                    $button .= '</div>';
                    $button .= '</div>';
                    return $button;
                })
                ->addColumn('action', function ($models) {
                    if ($models->is_kirim != 1) {
                        $button = '<div class="d-flex">';
                        $button .= '<div class="mr-1">';
                        $button .= '<a href="'.route('create_request_form.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                        $button .= '</div>';
                        $button .= '<div>';
                        $button .= '<form action="' . route('create_request_form.destroy', $models->id) . '" method="POST">';
                        $button .= '<input type="hidden" name="_method" value="delete" />';
                        $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                        $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                        $button .= '</form>';
                        $button .= '</div>';
                        $button .= '</div>';
                    } else {
                        $button = '';
                    }
                    return $button;
                })
                ->rawColumns([
                    'action',
                    'is_role',
                    'print',
                    'kirim',
                    'status_kirim',
                    'end_date',
                    'ttd_requester',
                    'ttd_cmt',
                    'ttd_qa',
                    'ttd_it'
                ])
                ->make(true);
            }
        } else {
            if (request()->ajax()) {
                return datatables()->of($models)
                    ->addIndexColumn()
                    ->editColumn('purpose.name', function ($models) {
                        if ($models->purpose_id == null) {
                            $model = '-';
                        } else {
                            $model = $models->purpose['name'];
                        }

                        return $model;
                    })
                    ->editColumn('purpose_other', function ($models) {
                        return (empty($models->purpose_other) ? '-' : $models->purpose_other);
                    })
                    ->editColumn('user.name', function ($models) {
                        if ($models->user_id == null) {
                            $model = '-';
                        } else {
                            $model = $models->user['name'];
                        }

                        return $model;
                    })
                    ->editColumn('location.name', function ($models) {
                        if ($models->location_id == null) {
                            $model = '-';
                        } else {
                            $model = $models->location['name'];
                        }

                        return $model;
                    })
                    ->editColumn('send_at', function ($models) {
                        return Carbon::parse($models->send_at)->isoFormat('dddd, D MMMM Y HH:mm');
                    })
                    ->editColumn('start_date', function ($models) {
                        return Carbon::parse($models->start_date)->isoFormat('dddd, D MMMM Y');
                    })
                    ->editColumn('end_date', function ($models) {
                        if ($models->end_date == null) {
                            $end_date = '<img src="' . asset('assets/infinite.png') . '" width="18" />';
                        } else {
                            $end_date = Carbon::parse($models->end_date)->isoFormat('dddd, D MMMM Y');
                        }

                        return $end_date;
                    })
                    ->addColumn('ttd', function ($models) {
                        if (Auth::User()->is_role == 3) {
                            $ttd = $models->ttd_cmt ? 'Sudah Tanda Tangan' : 'Belum Tanda Tangan';
                            $checked = ($models->ttd_cmt ? 'checked="checked"' : '');
                        } elseif (Auth::User()->is_role == 4) {
                            $ttd = $models->ttd_qa ? 'Sudah Tanda Tangan' : 'Belum Tanda Tangan';
                            $checked = ($models->ttd_qa ? 'checked="checked"' : '');
                        } elseif (Auth::User()->is_role == 5) {
                            $ttd = $models->ttd_it ? 'Sudah Tanda Tangan' : 'Belum Tanda Tangan';
                            $checked = ($models->ttd_it ? 'checked="checked"' : '');
                        }


                        return '<input class="switch" type="checkbox" ' . $checked . ' data-id="' . $models->id . '" data-on-text="Aktif" data-handle-width="150" data-off-text="Off" data-on-color="success"/>'.$ttd;
                    })
                    ->addColumn('status_kirim', function ($models) {
                        if ($models->is_kirim == 1) {
                            $label  = "label label-lg label-success label-inline";
                            $status = "Terkirim";
                        } else {
                            $label  = "label label-lg label-info label-inline p-5";
                            $status = "Belum Terkirim";
                        }

                        return '<span class="label ' . $label . '">' . $status . '</span>';
                    })
                    ->addColumn('print', function ($models) {
                        $button = '<div class="d-flex">';
                        $button .= '<div class="mr-1">';
                        $button .= '<a href="'.route('create_request_form.print', $models->id).'" class="btn btn-sm btn-danger text-center"> <i class="m-0 p-0 fa fa-print"></i> Cetak</a>';
                        $button .= '</div>';
                        $button .= '</div>';
                        return $button;
                    })
                    ->rawColumns(['print','status_kirim','ttd', 'end_date'])
                    ->make(true);
            }
        }
    }
}
