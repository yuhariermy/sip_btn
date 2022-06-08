<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailConnection;
use Illuminate\Http\Request;
use Validator;

class DetailConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->other) {
            $validator = Validator::make($request->all(), [
                'other' => 'required|string',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'form_id'               => 'required',
                'type_connection_id'    => 'required',
                'source_name'           => 'required',
                'source_ip_address'     => 'required',
                'destination_name'     => 'required',
                'destination_ip_address'   => 'required',
                'tcp'                   => 'sometimes',
                'udp'                   => 'sometimes',
                'port'                  => 'required'
            ]);
        }

        if ($validator->passes()) {
            $count = count($request->source_ip_address);
            for ($i = 0; $i < $count; $i++) {
                $models = new DetailConnection;
                $models->create_request_form_id = $request->form_id;
                $models->connection_type_id = $request->type_connection_id;
                $models->source_name = $request->source_name;
                $models->source_ip_address = $request->source_ip_address[$i];
                $models->destination_name = $request->destination_name;
                $models->destination_ip_address = $request->destination_ip_address[$i];
                $models->tcp = !empty($request->tcp) ? 'Y' : 'N';
                $models->udp = !empty($request->udp) ? 'Y' : 'N';
                $models->port = $request->port;
                $models->other = $request->other;
                $models->save();
            }

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
        if($request->other) {
            $validator = Validator::make($request->all(), [
                'other' => 'required|string',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'form_id'               => 'required',
                'type_connection_id'    => 'required',
                'source_name'           => 'required',
                'source_ip_address'     => 'required',
                'destination_name'     => 'required',
                'destination_ip_address'   => 'required',
                'tcp'                   => 'sometimes',
                'udp'                   => 'sometimes',
                'port'                  => 'required'
            ]);
        }

        if ($validator->passes()) {
            $models = DetailConnection::find($request->id);
            $models->create_request_form_id = $request->form_id;
            $models->connection_type_id  = $request->type_connection_id;
            $models->source_name = $request->source_name;
            $models->source_ip_address = $request->source_ip_address;
            $models->destination_name = $request->destination_name;
            $models->destination_ip_address = $request->destination_ip_address;
            $models->tcp = !empty($request->tcp) ? 'Y' : 'N';
            $models->udp = !empty($request->udp) ? 'Y' : 'N';
            $models->port = $request->port;
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
        $models = DetailConnection::find($request->connection_id)->delete();

        return redirect()->route('create_request_form.edit', $request->form_id)
                        ->with('success_connnection','Detail Connection berhasil di hapus');
    }
}
