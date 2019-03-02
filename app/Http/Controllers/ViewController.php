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

class ViewController extends Controller
{
   public function getUsers($id)
   {
   	
   	$rolex = User_roles::find($id);
      $urole = DB::table('users')->where('role',$id)->get();
   	$roles = User_roles::all();
   	$deps = Departments::all();

      if(Auth::user()->role == 1){
   	  return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole);
      }
      elseif(Auth::user()->role == 2){
         return view('admin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole);
      }
   }

    public function getDeps($id)
   {
   	
   	$depsx = Departments::find($id);
   	$roles = User_roles::all();
   	$deps = Departments::all();

   	return view('superadmin.showdeps')->with('depsx',$depsx)->with('deps',$deps)->with('roles',$roles);
   }
}
