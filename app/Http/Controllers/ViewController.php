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
use App\Exports\PnotesExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Transfer_Requests;
use App\Graduate_Requests;
use App\Employees;
use App\Cities;
use App\Case_Type;
use App\Logs;
use App\Dismissal_Reason;
use App\Doctors_Progress_Notes;
use Hash;
use Session;

class ViewController extends Controller
{
   public function getUsers($id)
   {
   	
   	$rolex = User_roles::find($id);
    $urole = Users::where('role',$id)->with('user_departments')->with('user_roles')->get();
   	$roles = User_roles::all();
   	$deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
   	  return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
      }
      elseif(Auth::user()->user_role()->firat()->name == 'Admin'){
         return view('admin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
      }
   }

    public function getDeps($id)
   {
   	
   	$depsx = Departments::find($id);
   	$roles = User_roles::all();
   	$deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $graduate = Graduate_Requests::all();

   	return view('superadmin.showdeps')->with('depsx',$depsx)->with('deps',$deps)->with('roles',$roles)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
   }

   public function showdepuser($did,$rid)
   {

      $rolex = User_roles::find($rid);
      $urole = Users::where('role',$rid)->where('department',$did)->with('user_departments')->with('user_roles')->get();
      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();

      return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);

   }
   public function showemployees()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $emp = Employees::all();
      $graduate = Graduate_Requests::all();

       if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }

   }

   public function showlogs()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $logs = Logs::all();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

   public function show_case_types()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $case = Case_Type::all();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

    public function show_cities()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $city = Cities::all();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

    public function show_jails()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

    public function show_dismiss_reason()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

   public function sampleform($id)
   {
      $notes = $this->get_notes($id);

      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.hello',compact('notes'));
      return $pdf->stream();
   }

   public function samplecsv()
   {
      //libxml_use_internal_errors(true);

       return Excel::download(new PnotesExport, 'notes.xls');

       //libxml_use_internal_errors(false);

   }

   public function get_notes($id)
   {
     $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();

     return $notes;
   }
}
