<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use Hash;
use Session;

class RegisterController extends Controller
{
    public function registernow(request $request)
    {
    	$user = new Users([
    		'fname' => $request->input('fname'),
    		'lname' => $request->input('lname'),
    		'username' => $request->input('username'),
    		'password' => Hash::make($request->input('password')),
    		'contact' => $request->input('contact'),
    		'email' => $request->input('email'),
    		'role' => $request->input('roleid'),
    		'department' => $request->input('department')
    	]);

    	$user->save();

    	Session::flash('alert-class', 'success'); 
		flash('User Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps);
        
    }

    public function register_role(request $request)
    {
        $role = new User_roles([
            'name' => $request->input('rname'),
            'description' => $request->input('rdesc')
        ]);

        $role->save();

        Session::flash('alert-class', 'success'); 
		flash('Role Created', '')->overlay();

		$roles = User_roles::all();
        $deps = Departments::all();
        return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps);
    }

    public function register_dep(request $request)
    {
        $role = new Departments([
            'department_name' => $request->input('depname'),
            'description' => $request->input('depdesc')
        ]);

        $role->save();

        Session::flash('alert-class', 'success'); 
		flash('Department Created', '')->overlay();

		$roles = User_roles::all();
        $deps = Departments::all();
        return view('superadmin.createdep')->with('roles',$roles)->with('deps',$deps);
    }

}
