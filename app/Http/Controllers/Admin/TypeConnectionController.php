<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeConnection;
use Illuminate\Http\Request;

class TypeConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $models = TypeConnection::orderBy('name', 'ASC')->get();
           
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models) {
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('type_connection.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                $button .= '</div>';
                $button .= '<div>';
                $button .= '<form action="' . route('type_connection.destroy', $models->id) . '" method="POST">';
                $button .= '<input type="hidden" name="_method" value="delete" />';
                $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                $button .= '</form>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])    
            ->make(true);
        }
        return view('admin.typeconnection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.typeconnection.create');
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
            'name'      => 'required'
        ]);
  
        $model = new TypeConnection;
        $model->name = $request->name;
        $model->save();
  
        return redirect()->route('type_connection.index')
                        ->with('success','Type Connection created successfully');
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
        $typeconnection = TypeConnection::findOrFail($id);

        return view('admin.typeconnection.edit', compact('typeconnection'));
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
            'name'      => 'required'
        ]);
  
        $model = TypeConnection::findOrFail($id);
        $model->name = $request->name;
        $model->save();
  
        $request->session()->flash('message', 'Successfully modified the task!');
        return redirect()->route('type_connection.edit', ['type_connection' => $id])->with('success', 'Type Connection has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $models = TypeConnection::find($id)->delete();

        return redirect()->route('type_connection.index')
                        ->with('success','Type Connection berhasil di hapus');
    }
}
