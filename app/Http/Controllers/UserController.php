<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{

    public function admins()
    {
        $users = User::latest()->get();

        return view('backend.admins', compact('users'));
    }

    public function users()
    {
        $users = User::latest()->get();

        return view('backend.users', compact('users'));
    }

    public function bulkUpload(Request $request)
    {
        $request->validate(['excel' => 'required|file']);

        $excel = Excel::import(new UsersImport, $request->file('excel'));

        if ($excel){
            toastr()->success('Users added successfully!', 'Success!');
        }

        return back();
    }

    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:3',
            'role' => 'required|string',
        ]);

        $insert = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($insert) {
            toastr()->success('User Added Successfully');
        }

        return back();
    }

    public function dltUser($id)
    {
        $delete = User::where('id', $id)->delete();

        if ($delete) {
            toastr()->success('User Deleted Successfully!');
        }

        return back();
    }

    public function showUser($id)
    {
        $user = User::where('id', $id)->first();

        return view('backend.user_edit', compact('user'));
    }

    public function editUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|min:3',
            'email' => 'sometimes|string|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:3',
        ]);

        $user = User::findOrFail($id);
        $oldName = $user->name;

        //changin password
        if ($request->has('password')) {
            $update = $user->update([
                'password' => Hash::make($request->password),
            ]);

            if ($update) {
                toastr()->success('Password updated successfully!');
            }

            return back();
        }

        $update = $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        //update name on logs
        $fax = Pdf::where('user_name', $oldName)->update([
            'user_name' => $request->name
        ]);

        toastr()->success('Profile updated successfully!');
        return redirect(route('admins'));
    }
}
