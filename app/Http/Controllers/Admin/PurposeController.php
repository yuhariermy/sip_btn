<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purpose;
use Illuminate\Http\Request;

class PurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $models = Purpose::orderBy('name', 'asc')->get();
           
            return datatables()->of($models)
            ->addIndexColumn()
            ->addColumn('action', function ($models) {
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('purpose.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                $button .= '</div>';
                $button .= '<div>';
                $button .= '<form action="' . route('purpose.destroy', $models->id) . '" method="POST">';
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
        return view('admin.purpose.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.purpose.create');
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
  
        $model = new Purpose;
        $model->name = $request->name;
        $model->save();
  
        return redirect()->route('purpose.index')
                        ->with('success','Purpose created successfully');
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
        $purpose = Purpose::findOrFail($id);

        return view('admin.purpose.edit', compact('purpose'));
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
  
        $model = Purpose::findOrFail($id);
        $model->name = $request->name;
        $model->save();
  
        $request->session()->flash('message', 'Successfully modified the task!');

        return redirect()->route('purpose.edit', ['purpose' => $id])->with('success', 'Purpose has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $models = Purpose::find($id)->delete();

        return redirect()->route('purpose.index')
                        ->with('success','Purpose berhasil di hapus');
    }
}
