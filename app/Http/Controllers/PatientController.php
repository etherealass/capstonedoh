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

class PatientController extends Controller
{
    public function addpatient()
    {
    	$roles = User_roles::all();
		$deps = Departments::all();

    	return view('superadmin.addpatient')->with('roles',$roles)->with('deps',$deps);
    }

    public function refer()
    {
    	$roles = User_roles::all();
		$deps = Departments::all();

    	return view('superadmin.refpatient')->with('roles',$roles)->with('deps',$deps);
    }
}
