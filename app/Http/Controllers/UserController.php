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
use App\Transfer_Requests;
use App\Logs;
use App\Graduate_Requests;
use Hash;
use Session;

class UserController extends Controller
{
	public function chooseuser_role()
	{
		$roles = User_roles::where('parent',0)->get();
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
		$transfer = Transfer_Requests::all();
		$graduate = Graduate_Requests::all();

		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
		}
		elseif(Auth::user()->user_role()->first()->name == 'Admin'){
			return view('admin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
		}
		else{
			return abort(404);
		}
	}

	public function create_user($id)
	{
		$roles = User_roles::all();
		$rolex = User_roles::find($id);
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
		$transfer = Transfer_Requests::all();
		$graduate = Graduate_Requests::all();
		$designation = User_roles::where('parent','!=','0')->get();

		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.createuser')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation',$designation);
		}
		elseif(Auth::user()->user_role()->first()->name == 'Admin'){
			return view('admin.createuser')->with('roles',$roles)->with('deps',$deps)->with('rolex',$rolex)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation',$designation);
		}
		else{
			return abort(404);
		}
	}

	public function change_pass(Request $request)
	{
		$user = Users::where('id',$request->input('userid'))->update(['password' => Hash::make($request->input('newpass'))]);

		Session::flash('alert-class', 'success'); 
		flash('Password Changed', '')->overlay();

		return back();
	}

	public function createuserrole()
	{
		$roles = User_roles::all();
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
		$transfer = Transfer_Requests::all();
		$graduate = Graduate_Requests::all();

		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.createrole')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
		}
		else{
			return abort(404);
		}
	}

	public function postcreate_dep()
	{
		$roles = User_roles::all();
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
		$transfer = Transfer_Requests::all();
		$graduate = Graduate_Requests::all();
		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.postcreatedep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
		}
		else{
			return abort(404);
		}
	}

	public function create_depnow()
	{
		$roles = User_roles::all();
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
		$transfer = Transfer_Requests::all();
		$graduate = Graduate_Requests::all();
		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.createdep')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
		}
		else{
			return abort(404);
		}
	}

	public function deletenow(Request $request)
	{
		$deleteuser = User_roles::findorfail($request->role)->get();

		foreach($deleteuser as $delete){
			$name = $delete->name;
		}

		date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Role Deletion',
            'action' => 'Deleted '.$name.' role ',
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();

		$deleteuser->delete();
		

		$deleterole = DB::table('users')->where('role',$request->role)->delete();

		Session::flash('alert-class', 'danger'); 
		flash('Role Deleted', '')->overlay();

		return back();
	}

	public function updatenow(Request $request)
	{
		$user = Users::where('id',$request->userid)->get();

		$users = Users::findorfail($request->userid);

		
		$users->update($request->all());

		foreach($user as $us)
		{
			$id  = $us->id;
		}

		date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'User Updated',
            'action' => 'Updated credentials for User no. '.$id,
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();

		Session::flash('alert-class', 'success'); 
		flash('Successfully Updated', '')->overlay();
 
		return redirect()->back();
	}

	public function deleteuser(Request $request)
	{
		$deleteuser = Users::findorfail($request->user_id);
		$deleteuser->delete();

		date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'User Deletion',
            'action' => 'Deleted User no. '.$request->input('user_id'),
            'date_time' => date('M-j-Y g:i A'),
        ]);

        $logs->save();

		Session::flash('alert-class', 'danger'); 
		flash('Successfully Deleted', '')->overlay();

        return back();
	}

}
