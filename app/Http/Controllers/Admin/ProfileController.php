<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserSign;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'thumbnail' => 'sometimes|file|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
        ]);

        if ($request->hasFile('thumbnail')) {
            $path = $request->thumbnail->store('sign');

            UserSign::updateOrCreate(
                [
                    'user_id' => $user->id
                ],
                [
                    'attachment' => $path
                ]
            );
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile has been updated!');
    }
}
