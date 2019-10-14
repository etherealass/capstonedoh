<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Transfer_Requests;
use App\Employees;
use App\Cities;
use App\Case_Type;
use App\Graduate_Requests;
use App\Dismissal_Reason;
use App\Logs;
use App\City_Jails;
use App\Checklist;
use Notification;
use Hash;
use Session;

class OthersController extends Controller
{
	public function add_a_city()
	{
		$roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcity')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcity')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
	}

	public function addcity(Request $request)
	{

		$validation = $this->validate($request,[
			'name' => 'required|unique:cities',
		]);

     	if(!$validation){
        $errors = new MessageBag(['name' => ['City name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
      	}
      	
      	else{
		$city = new Cities([
			'name' => $request->input('name'),
		]);

		$city->save();

		Session::flash('alert-class', 'success'); 
		flash('City Created', '')->overlay();

		$roles = User_roles::all();
      	$deps = Departments::all();
      	$users = Users::find(Auth::user()->id);
      	$transfer = Transfer_Requests::all();
      	$city = Cities::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city);
        }
	  }
	}
    
    public function deletecity(Request $request)
    {
    
    $city = Cities::where('id',$request->input('cityid'))->update(['flag' => 'deleted']);

    Session::flash('alert-class', 'danger'); 
		flash('City Deleted', '')->overlay();

		return back();
    }

    public function activatecity(Request $request)
    {
    
    $city = Cities::where('id',$request->input('cityid'))->update(['flag' => NULL]);

    Session::flash('alert-class', 'success'); 
    flash('City Activated', '')->overlay();

    return back();
    }

  public function add_a_city_jail()
  {
    $roles = User_roles::all();
    $deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcityjail')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcityjail')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
      }
  }

  public function addjail(Request $request)
  {

    $jail_id = rand();

    $validation = $this->validate($request,[
      'name' => 'required|unique:city__jails',
    ]);

      if(!$validation){
        $errors = new MessageBag(['name' => ['City Jail name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
        }
        
        else{
    $jail = new City_Jails([
      'jail_id' => $jail_id,
      'name' => $request->input('name'),
    ]);

    $jail->save();

    Session::flash('alert-class', 'success'); 
    flash('Jail Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $jails = City_Jails::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('jails',$jails);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('jails',$jails);
        }
    }
  }

   public function deletejail(Request $request)
   {
      $city = City_Jails::where('id',$request->input('jailid'))->update(['flag' => 'deleted']);

      Session::flash('alert-class', 'danger');
      flash('Jail Deleted', '')->overlay();

      return back();
    }

    public function activatejail(Request $request)
    {
      $city = City_Jails::where('id',$request->input('jailid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success');
      flash('Jail Activated', '')->overlay();

      return back();
    }

    public function add_a_checklist()
  {
    $roles = User_roles::all();
    $deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $list = Checklist::where(function ($list) {
      $list->where('parent','=',0)
           ->orWhere('has_sublist','=',1);
    })->get();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addchecklist')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('list',$list);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addchecklist')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('list',$list);
      }
  }

    public function addchecklist(Request $request)
  {

    if($request->input('parentlist') == NULL){
      $parent = 0;
      $hassublist = 0;
    }
    else{
      $parent = $request->input('parentlist');
      $hassublist = $request->input('slist');
    }

      $list = new Checklist([
        'parent' => $parent,
        'name' => $request->input('name'),
        'has_sublist' => $hassublist
      ]);

        $list->save();

        Session::flash('alert-class', 'success'); 
        flash('List Added', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $checklist = Checklist::all();

       if($request->input('parentlist') == NULL){
        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('/show_checklist')->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return redirect('/show_checklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist);
        }
      }
      else{
        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return redirect('/show_sub_checklist/'.$request->input('parentlist'))->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return redirect('/show_sub_checklist/'.$request->input('parentlist'))->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist);
        }
      }
  }

   public function deletechecklist(Request $request)
    {
      $list = Checklist::where('id',$request->input('listid'))->update(['flag' => 'deleted']);
      $sublist = Checklist::where('parent',$request->input('listid'))->update(['flag' => 'deleted']);

      Session::flash('alert-class', 'danger');
      flash('List Deleted', '')->overlay();

      return back();
    }

     public function updatechecklist(Request $request)
    {
      $list = Checklist::where('id',$request->input('listid'))->update(['name' => $request->input('listname')]);

      Session::flash('alert-class', 'success');
      flash('List Updated', '')->overlay();

      return back();
    }


    public function activatechecklist(Request $request)
    {
      $city = Checklist::where('id',$request->input('listid'))->update(['flag' => NULL]);
      $sublist = Checklist::where('parent',$request->input('listid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success');
      flash('List Activated', '')->overlay();

      return back();
    }


  public function add_a_casetype()
	 {
		    $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addcasetype')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addcasetype')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
        }
	 }


	public function add_casetype(Request $request)
	{
		$case_id = rand();

		$validation = $this->validate($request,[
			'case_name' => 'required|unique:case__types',
		]);

     	if(!$validation){
        $errors = new MessageBag(['case_name' => ['City name should be unique']]);
           return Redirect::back()->withErrors($errors)->withInput(Input::all());
      	}
      	
      	else{
		$case = new Case_Type([
			'case_id' => $case_id,
			'case_name' => $request->input('case_name'),
			'court_order' => $request->input('court'),
		]);

		$case->save();

    $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Case Type Created',
            'action' => 'Created Case Type no. '.$case_id,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

		Session::flash('alert-class', 'success'); 
		flash('Case Type Created', '')->overlay();

		$roles = User_roles::all();
      	$deps = Departments::all();
      	$users = Users::find(Auth::user()->id);
      	$transfer = Transfer_Requests::all();
      	$case = Case_Type::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case);
        }
	  }
	}

	public function delete_case(Request $request)
    {
    	$case = Case_Type::where('id',$request->input('caseid'))->update(['flag' => 'deleted']);


    	Session::flash('alert-class', 'danger'); 
		  flash('Case Type Deleted', '')->overlay();

		  return back();
    }

    public function activate_case(Request $request)
    {
      $case = Case_Type::where('id',$request->input('caseid'))->update(['flag' => NULL]);


      Session::flash('alert-class', 'success'); 
      flash('Case Type Activated', '')->overlay();

      return back();
    }

    public function add_a_reason()
   {
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.addreason')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.addreason')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
   }

   public function add_reason(Request $request)
  {
    $reason_id = rand();

    //$validation = $this->validate($request,[
    //'reason' => 'required|unique:dismissal__reasons'
   // ]);

     // if(!$validation){
      //  $errors = new MessageBag(['reason' => ['Reason already exist']]);
       //    return Redirect::back()->withErrors($errors)->withInput(Input::all());
      //  }
        
      //  else{
          
      $reason = new Dismissal_Reason([
          'dismissal_id' => $reason_id,
          'reason' => $request->input('name'),
          
          ]);

        $reason->save();

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Dismissal Reason Created',
            'action' => 'Created Dismissal Reason no. '.$reason_id,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();


    Session::flash('alert-class', 'success'); 
    flash('Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $reasons = Dismissal_Reason::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
             return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('gradute',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate);
        }
    //}
  }

  public function deletereason(Request $request)
  {
      $reason = Dismissal_Reason::where('id',$request->input('reasonid'))->update(['flag' => 'deleted']);


      Session::flash('alert-class', 'danger'); 
      flash('Deleted Reason')->overlay();

      return back();
  }

   public function activatereason(Request $request)
  {
      $reason = Dismissal_Reason::where('id',$request->input('reasonid'))->update(['flag' => NULL]);

      Session::flash('alert-class', 'success'); 
      flash('Activated Reason')->overlay();

      return back();
  }

}
