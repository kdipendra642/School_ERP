<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView()
    {
        // $users = User::all();
        $data['user'] = User::where('usertype', 'Admin')->get();
        return view('backend.user.view_user', $data);
    }

    public function UserAdd()
    {
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|unique:users|email|max:255',
        //     'password' => 'required'
        // ]);
        // dd($request->all());

        $data = new User();
        $data->usertype = 'Admin';
        $code = rand(0000, 9999);
        $data->name = $request->name;
        $data->role = $request->role;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User inserted successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id)
    {
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }

    public function UserUpdate(Request $request, $id)
    {
        $data = User::find($id);
        $data->name = $request->name;
        $data->role = $request->role;
        $data->email = $request->email;
        $data->save();

        $notification = array(
            'message' => 'User updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id)
    {
        $notification = array(
            'message' => 'User deleted successfully.',
            'alert-type' => 'warning',
        );

        $data = User::find($id);
        $data->delete();

        return redirect()->route('user.view')->with($notification);
    }
}
