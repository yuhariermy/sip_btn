<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailAccess;
use Illuminate\Http\Request;
use Validator;

class DetailAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id'               => 'required',
            'type_access_id'    => 'required',
            'full_name'           => 'required',
            'server_name'     => 'required',
            'db_name'     => 'required',
            'source_ip_address'   => 'required|ip'
        ]);

        if ($validator->passes()) {
            $models = new DetailAccess;
            $models->create_request_form_id = $request->form_id;
            $models->access_type_id   = $request->type_access_id;
            $models->fullname = $request->full_name;
            $models->server_name = $request->server_name;
            $models->db_name = $request->db_name;
            $models->ip_address = $request->source_ip_address;
            $models->other = $request->other;
            
            $models->save();

            return response()->json(['form_id' => $request->form_id]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_id'               => 'required',
            'type_access_id'    => 'sometimes',
            'full_name'           => 'required',
            'server_name'     => 'required',
            'db_name'     => 'required',
            'source_ip_address'   => 'required|ip'
        ]);

        if ($validator->passes()) {
            $models = DetailAccess::find($request->id);
            $models->create_request_form_id = $request->form_id;
            $models->access_type_id   = $request->type_access_id;
            $models->fullname = $request->full_name;
            $models->server_name = $request->server_name;
            $models->db_name = $request->db_name;
            $models->ip_address = $request->source_ip_address;
            $models->other = $request->other;
            
            $models->save();

            return response()->json(['form_id' => $request->form_id]);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $models = DetailAccess::find($request->access_id)->delete();

        return redirect()->route('create_request_form.edit', $request->form_id)
                        ->with('success_access','Detail Access berhasil di hapus');
    }
}
