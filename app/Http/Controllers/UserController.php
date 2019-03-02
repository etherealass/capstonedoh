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

class UserController extends Controller
{
	public function chooseuser_role()
	{
		$roles = User_roles::all();
		$deps = Departments::all();

		if(Auth::user()->role == 1){
			return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps);
		}
		elseif(Auth::user()->role == 2){
			return view('admin.chooseuser')->with('roles',$roles)->with('deps',$deps);
		}
	}

	public function create_user($id)
	{
		$roles = User_roles::all();
		$rolex = User_roles::find($id);
		$deps = Departments::all();

		return view('superadmin.createuser')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex);
	}

	public function createuserrole()
	{
		$roles = User_roles::all();
		$deps = Departments::all();

		if(Auth::user()->role == 1){
			return view('superadmin.createrole')->with('roles',$roles)->with('deps',$deps);
		}
		else{
			return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
		}
	}

	public function postcreate_dep()
	{
		$roles = User_roles::all();
		$deps = Departments::all();

		if(Auth::user()->role == 1){
			return view('superadmin.postcreatedep')->with('roles',$roles)->with('deps' ,$deps);
		}
		else{
			return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
		}
	}

	public function create_depnow()
	{
		$roles = User_roles::all();
		$deps = Departments::all();

		if(Auth::user()->role == 1){
			return view('superadmin.createdep')->with('roles',$roles)->with('deps' ,$deps);
		}
		else{
			return redirect()->route('user.dashboard')->with('roles',$roles)->with('deps',$deps);
		}
	}

	public function deletenow(Request $request)
	{
		$deleteuser = User_roles::findorfail($request->role);
		$deleteuser->delete();

		$deleterole = DB::table('users')->where('role',$request->role)->delete();

		Session::flash('alert-class', 'danger'); 
		flash('Role Deleted', '')->overlay();

		return back();
	}

	public function updatenow(Request $request)
	{
		$user = Users::find($request->userid);
		$user->update($request->all());

		Session::flash('alert-class', 'success'); 
		flash('Successfully Updated', '')->overlay();
 
		return redirect()->back();
	}

	public function deleteuser(Request $request)
	{
		$deleteuser = Users::findorfail($request->user_id);
		$deleteuser->delete();

		Session::flash('alert-class', 'danger'); 
		flash('Successfully Deleted', '')->overlay();

        return back();
	}

}
