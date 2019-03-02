<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use Hash;
use Session;

class LoginController extends Controller
{

    public function home(request $request) 
    {

      $roles = User_roles::all();
      $deps = Departments::all();

      if(Auth::check()){
        return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
      }
      else{
        return redirect('/login')->with('roles',$roles)->with('deps',$deps);
      }
    }

    public function loginnow(request $request)
    {
        $this->validate($request,[
        'username' =>'required',
        'password'=>'required'
      ]);

       $roles = User_roles::all();
       $deps = Departments::all();

      if(Auth::attempt(['username'=>$request->input('username'), 'password'=>$request->input('password')]))
        {
          return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
        }
        else{
          $errors = new MessageBag(['password' => ['Username and/or password invalid.']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::except('password'));
        }
    }

    public function login()
    {

      $roles = User_roles::all();
      $deps = Departments::all();


      if(Auth::check()){
        return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
      }
      else{
        return redirect('/login')->with('roles',$roles)->with('deps',$deps);
      }
    }

    public function logout()
    {

      $roles = User_roles::all();
      Auth::logout(); 
      return redirect()->route('login')->with('roles',$roles);
    }

    public function getProfile(request $request)
    {
      $roles = User_roles::all();
      $deps = Departments::all();

      if(Auth::user()->role == 1){
        return view('superadmin.index')->with('roles',$roles)->with('deps',$deps);
      }
      else if(Auth::user()->role == 2){
         return view('admin.index')->with('roles',$roles)->with('deps',$deps);
      }
    }
}
