<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Gate;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();

        return view('admin.user.index')->with('users',$users);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //ther is deny and allow. it will check if hasRole in User.php is admin as set in authservice
        //if they dont have admin role will redirect to admin users else run rest of code below
        if(Gate::denies('edit-users')){
            return redirect('/admin/users');

        }
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user.edit')->with([
            'user'=>$user,
            'roles'=>$roles
            ]);

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
        //
        //dd($request->roles);
        $user = User::findOrFail($id);
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Gate::denies('delete-users')){
            return redirect('/admin/users');

        }
        $user = User::findOrFail($id);
        $user->roles()->detach();//deletes relationshhip in role user table.//deletes role its linked to in role table
        $user->delete();

        return redirect('/admin/users');//same as return redirect()->route('admin.users.index')
    }
}
