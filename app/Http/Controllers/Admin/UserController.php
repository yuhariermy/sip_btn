<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Libraries\Helpers;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $models = User::orderBy('created_at', 'DESC')->get();

            return datatables()->of($models)
            ->addIndexColumn()
            ->editColumn('is_role', function ($models) {
                return Helpers::role($models->is_role);
            })
            ->addColumn('action', function ($models) {
                $button = '<div class="d-flex">';
                $button .= '<div class="mr-1">';
                $button .= '<a href="'.route('user.edit', $models->id).'" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-alt"></i> Ubah</a>';
                $button .= '</div>';
                $button .= '<div>';
                $button .= '<form action="' . route('user.destroy', $models->id) . '" method="POST">';
                $button .= '<input type="hidden" name="_method" value="delete" />';
                $button .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
                $button .= '<button type="submit" name="edit" id="'.$models->id.'" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash-alt"></i>Hapus</button>';
                $button .= '</form>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action','is_role'])
            ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'is_role' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_role = $request->is_role;
        $user->save();

        return redirect()->route('user.index')
                        ->with('success', 'User created successfully');
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
        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
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
            'name'   => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email'   => 'sometimes|email|unique:users,email,'.$id,
            'password'   => 'sometimes',
            'is_role'   => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->is_role = $request->is_role;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('message', 'Successfully modified the task!');

        return redirect()->route('user.edit', ['user' => $id])->with('success', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $models = User::find($id)->delete();

        return redirect()->route('user.index')
                        ->with('success', 'User berhasil di hapus');
    }
}
