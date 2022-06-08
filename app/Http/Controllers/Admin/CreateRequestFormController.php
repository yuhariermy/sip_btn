<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreateRequestForm;
use App\Models\DetailAccess;
use App\Models\DetailConnection;
use App\Models\Location;
use App\Models\Purpose;
use App\Models\TypeAccess;
use App\Models\TypeConnection;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Libraries\Helpers;
use App\Models\UserSign;
use PDF;
use Auth;

class CreateRequestFormController extends Controller
{
    protected $user_id;

    public function __construct()
    {
        $this->middleware(function (Request $request, $next) {
            if (!\Auth::check()) {
                return redirect('/login');
            }

            // you can access user id here
            $this->user_id = Auth::User()->id;
            $this->is_role = Auth::User()->is_role;

            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->is_role == 1 || $this->is_role == 2) {
            if (request()->ajax()) {
                $models = CreateRequestForm::with('user', 'purpose', 'location')
                          ->where('user_id', $this->user_id)
                          ->orderBy('send_at', 'DESC')
                          ->get();

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
                    ->editColumn('send_at', function ($models) {
                        return Carbon::parse($models->send_at)->isoFormat('dddd, D MMMM Y HH:mm');
                    })
                    ->addColumn('kirim', function ($models) {
                        if ($models->is_kirim == 1) {
                            return Carbon::parse($models->send_at)->isoFormat('dddd, D MMMM Y HH:mm');
                        } else {
                            $button = '<div class="d-flex">';
                            $button .= '<div class="mr-1">';
                            $button .= '<button type="button" class="send btn btn-sm btn-primary text-center" data-id="' . $models->id . '"> <i class="m-0 p-0 fa fa-paper-plane"></i> Kirim</button>';
                            $button .= '</div>';
                            $button .= '</div>';

                            return $button;
                        }
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
                $models = CreateRequestForm::with('user', 'purpose', 'location')
                    ->where('is_kirim', 1)
                    ->orderBy('send_at', 'DESC')
                    ->get();

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
                        if ($this->is_role == 3) {
                            $ttd = $models->ttd_cmt ? 'Sudah Tanda Tangan' : 'Belum Tanda Tangan';
                            $checked = ($models->ttd_cmt ? 'checked="checked"' : '');
                        } elseif ($this->is_role == 4) {
                            $ttd = $models->ttd_qa ? 'Sudah Tanda Tangan' : 'Belum Tanda Tangan';
                            $checked = ($models->ttd_qa ? 'checked="checked"' : '');
                        } elseif ($this->is_role == 5) {
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

        if ($this->is_role == 1 || $this->is_role == 2) {
            return view('admin.createrequestform.index');
        } else {
            return view('admin.createrequestform.index2');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::orderBy('name', 'ASC')->get();
        $purposes = Purpose::orderBy('created_at', 'ASC')->get();
        return view('admin.createrequestform.create', compact('locations', 'purposes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_pcr'          => 'required|alpha_num',
            'attachment'      => 'sometimes|file|mimes:doc,docx,xlsx,pdf,jpeg,png,jpg|max:2048',
            'purpose_id'      => 'required',
            'location_id'     => 'required',
            'start_date'      => 'required|date|after:yesterday',
            'end_date'        => $request->permanent ? 'sometimes' : 'sometimes|date|after_or_equal:start_date'
        ]);

        // Upload Template
        $tujuan_upload = 'attachment';
        $file_template = $request->file('thumbnail');

        if (isset($file_template)) {
            $nama_file  = $file_template->store($tujuan_upload);
        } else {
            $nama_file = ' ';
        }

        $models = new CreateRequestForm;
        $models->user_id = $this->user_id;
        $models->no_pcr = $request->no_pcr;
        $models->purpose_id = $request->purpose_id;
        $models->location_id = $request->location_id;
        $models->start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i');
        $models->end_date = $request->permanent ? null : Carbon::parse($request->end_date)->format('Y-m-d H:i');
        $models->attachment = $nama_file;
        $models->save();

        return redirect()->route('create_request_form.index')
                        ->with('success', 'Data Request Form berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forms = CreateRequestForm::findOrFail($id);
        $form_id = $id;
        $data = [
            'start_date' => Carbon::parse($forms->start_date)->format('d-m-Y'),
            'end_date' => Carbon::parse($forms->end_date)->format('d-m-Y')
        ];

        $locations = Location::orderBy('name', 'ASC')->get();
        $purposes = Purpose::orderBy('created_at', 'ASC')->get();

        $detail_requests = DetailConnection::with('type_connection')->where('create_request_form_id', $id)->orderBy('created_at', 'DESC')->get();
        $detail_accesses = DetailAccess::with('type_access')->where('create_request_form_id', $id)->orderBy('created_at', 'DESC')->get();

        $type_connections = TypeConnection::orderBy('created_at', 'ASC')->get();
        $type_accesses = TypeAccess::orderBy('created_at', 'ASC')->get();

        return view(
            'admin.createrequestform.edit',
            compact('forms', 'form_id', 'data', 'locations', 'purposes', 'detail_requests', 'detail_accesses', 'type_connections', 'type_accesses')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_pcr'          => 'required|alpha_num',
            'attachment'      => 'sometimes|file|mimes:doc,docx,xlsx,pdf,jpeg,png,jpg|max:2048',
            'purpose_id'      => 'required',
            'location_id'     => 'required',
            'detail_request'  => 'sometimes',
            'detail_access'   => 'sometimes',
            'start_date'      => 'required|date|after:yesterday',
            'end_date'        => $request->permanent ? 'sometimes' : 'sometimes|date|after_or_equal:start_date'
        ]);

        // Upload Template
        $tujuan_upload = 'attachment';
        $file_template = $request->file('thumbnail');


        $models = CreateRequestForm::findOrFail($id);

        // If Check Detail Request Connection
        $connections = DetailConnection::where('create_request_form_id', $id)->count();
        if ($connections > 0) {
            $models->detail_request = $request->detail_request;
        } else {
            // $request->session()->flash('error', 'Data Detail Connection Gagal di Ubah');
        }

        $requests = DetailAccess::where('create_request_form_id', $id)->count();
        if ($requests > 0) {
            $models->detail_access = $request->detail_access;
        } else {
            // $request->session()->flash('error', 'Data Detail Request Gagal di Ubah');
        }

        if (isset($file_template)) {
            if (!empty($models->attachment)) {
                Storage::delete($models->attachment);
            }

            $nama_file  = $file_template->store($tujuan_upload);

            $models->attachment = $nama_file;
        } else {
            $nama_file = ' ';
        }

        $models->user_id = $this->user_id;
        $models->no_pcr = $request->no_pcr;
        $models->purpose_id = $request->purpose_id;
        $models->location_id = $request->location_id;

        $models->start_date = Carbon::parse($request->start_date)->format('Y-m-d H:i');
        $models->end_date = $request->permanent ? null : Carbon::parse($request->end_date)->format('Y-m-d H:i');
        $models->save();

        $request->session()->flash('message', 'Data Berhasil di Ubah');

        return redirect()->route('create_request_form.edit', $id)->with('success', 'Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $models = CreateRequestForm::find($id)->delete();

        return redirect()->route('create_request_form.index')
                        ->with('success', 'Request Form berhasil di hapus');
    }

    public function send(Request $request)
    {
        $id = $request->id;

        $idLogin = Auth::user()->id;

        $userSign = UserSign::where('user_id', $idLogin)->first();
        if(!$userSign) {
            $msg = [
                'status' => 'error3',
            ];
            return response()->json($msg);
        }

        /** Cek Surat Sebelumnya */
        // $beforeId = CreateRequestForm::selectRaw('max(id) as id')->where('id', '<', $id)->first();
        // $before = CreateRequestForm::where('id', $beforeId->id)->first();
        // if($before->is_kirim != 1) {
        //     $msg = array(
        //         'status' => 'error4',
        //     );
        //     return response()->json($msg);
        // }
        /** End Cek Surat Sebelumnya */

        $forms = CreateRequestForm::where('id', $id)->first();
        $connections = DetailConnection::where('create_request_form_id', $id)->count();
        $requests = DetailAccess::where('create_request_form_id', $id)->count();

        // if(empty($forms->detail_request) || empty($forms->detail_access)) {
        //     $msg = array(
        //         'status' => 'error2',
        //     );
        //     return response()->json($msg);
        //     exit();
        // }

        if ($connections < 1 && $requests < 1) {
            $msg = array(
                'status' => 'error1',
            );
            return response()->json($msg);
            exit();
        }

        $models = CreateRequestForm::findOrFail($id);
        $no = Helpers::checkNumber('create_request_forms');
        $no_surat = Helpers::autonumber('create_request_forms', 'id', '/CRF/ITOD/OCMD/'.date('m').'/'.date('Y'));
        $models->no = $no;
        $models->no_surat = $no_surat;
        $models->is_kirim = 1;
        $models->ttd_requester = $idLogin;
        $models->send_at = date('Y-m-d H:i:s');
        $models->save();
        Helpers::notification(3, "Form Request No. ".$no_surat." telah dikirim dan sudah di ttd Requester", 0);
        $msg = array(
            'status' => 'success',
        );

        return response()->json($msg);
    }

    public function send_cancel(Request $request)
    {
        $id = $request->id;
        $models = CreateRequestForm::findOrFail($id);
        $models->is_kirim = 0;
        $models->save();

        $msg = array(
            'status' => 'success',
        );

        return response()->json($msg);
    }

    public function ttd(Request $request)
    {
        $id = $request->id;

        $userSign = UserSign::where('user_id', $this->user_id)->first();
        if(!$userSign) {
            $status = 'error';
            $message = 'Gagal! File tanda tangan anda belum ada!';
            return response()->json(['status' => $status,'message' => $message]);
        }

        $ttd = null;
        $before_role = null;
        $after_role = null;
        $roleText = null;
        $roleBeforeText = null;
        $roleAfterText = null;
        switch ($this->is_role) {
            case 3:
                $after_role = 'ttd_qa';
                $ttd = 'ttd_cmt';
                $roleText = 'CMT';
                $roleBeforeText = 'STAFF';
                $roleAfterText = 'QA';
                break;
            case 4:
                $before_role = 'ttd_cmt';
                $after_role = 'ttd_it';
                $ttd = 'ttd_qa';
                $roleText = 'QA';
                $roleBeforeText = 'CMT';
                $roleAfterText = 'ITS';
                break;
            case 5:
                $before_role = 'ttd_qa';
                $ttd = 'ttd_it';
                $roleText = 'ITS';
                $roleBeforeText = 'QA';
                break;
        }

        /** Ambil data form Request */
        $data = CreateRequestForm::where('id', $id)->first();

        /** Check Data tanda tangan saat ini */
        if($data->$ttd) {
            /** Cek Surat Setelahnya */
            $formAfter = $this->checkLastForm($data->no + 2);
            if(!is_null($formAfter)) {
                if($formAfter->$ttd) {
                    $status = 'error';
                    $message = 'Gagal! Surat selanjutnya sudah di approve!';
                    return response()->json(['status' => $status,'message' => $message]);
                }
            }
        }

        /** Cek Surat Sebelumnya */
        $formBefore = $this->checkLastForm($data->no);
        /** End Cek Surat Sebelumnya */

        // Jika surat sebelumnya ada
        if(!is_null($formBefore)) {
            /**
             * Jika surat sebelumnya belum di tanda tangan oleh role tersebut
             * Tampilkan pesan error
             */
            if($formBefore->$ttd <= 0) {
                $this->status = 'error';
                $this->message = 'Gagal! Surat Sebelum nya belum selesai';

            } else {
                /**
                 * Jika surat sebelumnya sudah di tanda tangan oleh role
                 * Lakukan pengecekan untuk tanda tangan role sebelumnya
                 */
                if($before_role !== null && $data->$before_role <= 0) {
                    $this->status = 'error';
                    $this->message = "Gagal! $roleBeforeText Belum TTD";
                } elseif($after_role !== null && $data->$after_role != 0) {
                    $this->status = 'error';
                    $this->message = "Gagal! $roleAfterText Sudah TTD";
                } else {
                    $this->updateSignByRole($data, $ttd, 'success');
                }
            }

        // Jika surat sebelumnya tidak ada
        } else {
            if($before_role !== null && $data->$before_role <= 0) {
                $this->status = 'error';
                $this->message = "Gagal! $roleBeforeText Belum TTD";
            } elseif($after_role !== null && $data->$after_role != 0) {
                $this->status = 'error';
                $this->message = "Gagal! $roleAfterText Sudah TTD";
            } else {
                $this->updateSignByRole($data, $ttd, 'success');
            }
        }

        return response()->json([
            'status' => $this->status,
            'message' => $this->message
        ]);
    }

    public function print($id)
    {
        $forms = CreateRequestForm::with('user', 'purpose', 'location')->findOrFail($id);

        $ttd_requester = UserSign::where('user_id', (int)  $forms->ttd_requester)->first();
        $ttd_cm = UserSign::where('user_id', (int) $forms->ttd_cmt)->first();
        $ttd_qa = UserSign::where('user_id', (int) $forms->ttd_qa)->first();
        $ttd_it = UserSign::where('user_id', (int) $forms->ttd_it)->first();

        $detail_requests = DetailConnection::with('type_connection')->where('create_request_form_id', $id)->orderBy('created_at', 'DESC')->get();
        $detail_accesses = DetailAccess::with('type_access')->where('create_request_form_id', $id)->orderBy('created_at', 'DESC')->get();

        $pdf = PDF::loadView(
            'admin.createrequestform.print',
            compact('forms', 'detail_requests', 'detail_accesses', 'ttd_requester', 'ttd_cm', 'ttd_qa', 'ttd_it')
        )->setPaper('a4', 'potrait');

        // return $pdf->download();
        return $pdf->stream();
    }

    public function checkLastForm(int $no)
    {
        if($no == 1) {
            return null;
        }

        return CreateRequestForm::where('no', (--$no))->first();
    }

    public function updateSignByRole($data, $ttd, $status)
    {
        $value = $data->$ttd > 0 ? null : $this->user_id;
        $data->update([
            $ttd => $value
        ]);

        $this->status = $status;
        $this->message = 'Berhasil' . ($value == null ? ' Membatalkan ' : ' ') . 'Tanda Tangan';

        $successFrom = null;
        switch ($this->is_role) {
            case 3:
                $successFrom = 'CMT';
                break;
            case 4:
                $successFrom = 'QA';
                break;
        }

        if($ttd == 'ttd_it' && $value !== null) {
            Helpers::notification($data->user_id, "Form Request No. " . $data->no_surat . " berstatus Selesai", 0);
        } else {
            Helpers::notification($this->is_role +1, "Form Request No. " . $data->no_surat . " sudah di tanda tangani " . $successFrom, 0);
        }
    }
}
