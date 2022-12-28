<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:users.index|users.create|users.edit|users.delete|users.changestatus']);
    }

    public function index()
	{
		$users = \App\User::with('roles')->get();

  		return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed',
            'username'  => 'required',
            'unit'      => 'required'
        ]);

        $user = User::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'username'  => $request->input('username'),
            'unit'     => $request->input('unit')
        ]);

        //assign role
        $user->assignRole($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(User $user)
    {
        $roles = Role::latest()->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user = User::findOrFail($user->id);

        if($request->input('password') == "") {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'username'  => $request->input('username'),
                'unit'     => $request->input('unit')
            ]);
        } else {
            $user->update([
                'name'      => $request->input('name'),
                'email'     => $request->input('email'),
                'password'  => bcrypt($request->input('password')),
                'username'  => $request->input('username'),
                'unit'     => $request->input('unit')
            ]);
        }

        //assign role
        $user->syncRoles($request->input('role'));

        if($user){
            //redirect dengan pesan sukses
            return redirect()->route('users.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('users.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
    
    public function destroy($id)
    {
        $user = \App\User::with('roles')->findOrFail($id);

        $user->roles()->detach();
        $user->delete();

        Alert::success('User Berhasil Dihapus');
        return redirect()->back();
    }

    public function changestatus(Request $request)
    {
        $user = \App\User::findOrFail($request->id);
        $status = $user->status;
        if($status == 'ACTIVE')
            {
                $user->update(['status' => 'INACTIVE']);
            }
        if($status == 'INACTIVE')
            {
                $user->update(['status' => 'ACTIVE']);
            }

        return redirect()->back();
    }
}
