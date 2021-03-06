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
use App\Dismissal_Records;
use App\Doctors_Progress_Notes;
use App\City_Jails;
use App\Patients;
use App\Patient_Intake_Information;
use App\ProgressNotes;
use App\Patient_Information;
use App\Patient_Event_List;
use App\Patient_History;
use App\Checklist;
use App\Checklist_Files;
use App\Civil_Status;
use App\Gender;
use App\Drugs_Abused;
use App\Educational_Attainment;
use App\Employment_Status;
use App\Services;
use App\Refers;
use App\User_departments;
use App\Bmi_records;
use App\Blood_sugar_records;
use App\Medical_records;
use Hash;
use Session;
use NumConvert;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Style_NumberFormat;
use Carbon\Carbon;


class ViewController extends Controller
{
   public function getUsers($id)
   {
   	
   	$rolex = User_roles::find($id);
    $urole = Users::where('role',$id)->where('flag',NULL)->with(['user_departments', 'user_roles'])->get();
  //  $urodep = User_departments::where('role',$id)->where('flag',NULL)->with('user_departments')->with('user_roles')->get();
   	$roles = User_roles::where('description','!=','Employee')->get();
   	$deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $graduate = Graduate_Requests::all();
    $designation = User_roles::where('parent', 3)->get();
    $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
    $udepts = User_departments::all();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id; 
            
        }

//
      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
   	  return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation', $designation)->with('user_dept', $depts)->with('udepts',$udepts);
      }
      elseif(Auth::user()->user_role()->first()->name == 'Admin'){
         return view('admin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('designation', $designation)->with('user_dept', $depts)->with('udepts',$udepts);
      }
   }

    public function getDeps($id)
   {
   	
   	$depsx = Departments::where('id',$id)->get();
   	$roles = User_roles::where('description','!=','Employee')->get();
   	$deps = Departments::all();
    $users = Users::find(Auth::user()->id);
    $transfer = Transfer_Requests::all();
    $graduate = Graduate_Requests::all();
    $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

   	return view('superadmin.showdeps')->with('depsx',$depsx)->with('deps',$deps)->with('roles',$roles)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
   }

   public function showdepuser($did,$rid)
   {

      $rolex = User_roles::find($rid);
      $urole = Users::where('role',$rid)->where('department',$did)->where('flag',NULL)->with('user_departments')->with('user_roles')->get();
      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();
      $udepts = User_departments::all();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      return view('superadmin.showusers')->with('rolex',$rolex)->with('deps',$deps)->with('roles',$roles)->with('urole' ,$urole)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts)->with('udepts',$udepts);

   }
   public function showemployees()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $emp = Employees::where('flag',NULL)->get();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

       if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showemployees')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }

   }

   public function viewemployee($id)
   {
      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $emp = Employees::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewemployee')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewemployee')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
     }

   public function viewuser($id)
   {
      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $uses = Users::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
   }

   public function viewuserx($id,$pid)
   {
      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $uses = Users::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      $notif = DB::table('notifications')->where('id',$pid)->update(['read_at' => date('Y-m-d')]);

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('user_dept', $depts);
        }
   }

   public function showlogs()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $logs = Logs::all();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else{

          return abort(404);
      }
   }

   public function show_my_logs($id)
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $logs = Logs::where('performer_id',$id)->get();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Doctor'){
            return view('doctor.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Psychiatrist'){
            return view('psychiatrist.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Dentist'){
            return view('dentist.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else{
          return abort(404);
        }
   }

   public function show_case_types()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $case = Case_Type::all();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('superadmin.casetypes')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate)->with('user_dept', $depts);
        }
        else{
          return abort(404);
        }
   }

    public function show_cities()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $city = Cities::all();
      $graduate = Graduate_Requests::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.cities')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('city',$city)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else{
          return abort(404);
      }
   }

    public function show_jails()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $jails = City_Jails::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('user_dept', $depts);
      }
      else{
          return abort(404);
      }
   }

    public function show_reports()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $jails = City_Jails::where('flag',NULL)->get();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

      $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      return view('superadmin.reports')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('user_dept', $depts);
   }

    public function show_dismiss_reason()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.reasons')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('user_dept', $depts);
      }
      else{
          return abort(404);
      }
   }

   public function show_civilstat()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $status = Civil_Status::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.civilstat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('status',$status)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin')
      {
            return view('superadmin.civilstat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('status',$status)->with('user_dept', $depts);
      }
      else
      {
          return abort(404);
      }
   }

   public function show_gender()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $gender = Gender::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.gender')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('gender',$gender)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin')
      {
            return view('superadmin.gender')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('gender',$gender)->with('user_dept', $depts);
      }
      else
      {
          return abort(404);
      }
   }

   public function show_dabused()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $dabused = Drugs_Abused::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.dabused')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('dabused',$dabused)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin')
      {
            return view('superadmin.dabused')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('dabused',$dabused)->with('user_dept', $depts);
      }
      else
      {
          return abort(404);
      }
      
   }

   public function show_eduatain()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $eduatain = Educational_Attainment::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.eduatain')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('eduatain',$eduatain)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin')
      {
            return view('superadmin.eduatain')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('eduatain',$eduatain)->with('user_dept', $depts);
      }
      else
      {
          return abort(404);
      }
      
   }

   public function show_estat()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $estat = Employment_Status::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.estat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('estat',$estat)->with('user_dept', $depts);
      }
      else if(Auth::user()->user_role()->first()->name == 'Admin')
      {
            return view('superadmin.estat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('estat',$estat)->with('user_dept', $depts);
      }
      else
      {
          return abort(404);
      }
      
   }

    public function show_checklist()
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $checklist = Checklist::where('parent',0)->get();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.checklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate)->with('user_dept', $depts);
        }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.checklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate)->with('user_dept', $depts);
       } else{
          return abort(404);
        }
   }

   public function show_sub_checklist($id)
   {

      $roles = User_roles::where('description','!=','Employee')->get();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $mainlist = Checklist::where('id',$id)->get();
      $checklist = Checklist::where('parent',$id)->get();
      $sublist = Checklist::all();
      $User_depart = User_departments::where('user_id', Auth::user()->id)->get();

        $depts = [];

        foreach ($User_depart as $user_depts) 
        {

            $depts[] = $user_depts->department_id;
            
        }

     
     if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.subchecklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate)->with('mainlist',$mainlist)->with('sublist',$sublist)->with('user_dept', $depts);
        }

    else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('superadmin.subchecklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate)->with('mainlist',$mainlist)->with('sublist',$sublist)->with('user_dept', $depts);
      }
      else{
          return abort(404);
      } 
   }

    public function getlist(request $request)
   {

    $pat = Patients::where('id',$request->patientid)->get();
    $listname = Checklist::where('id',$request->id)->get();
    $checklist = Checklist_Files::where('checklist_id',$request->id)->where('patient_id',$request->patientid)->where('department_id',$request->depid)->get();
    foreach($listname as $name)
    foreach($pat as $paty)

  if($paty->status == 'Enrolled'){

    $output = '';

    $output .= '<div class="container" style="margin-left: 0px">
                  <div class="row">
                    <div class="col-md-12">
                    <button style="margin-left:900px" class="btn btn-primary" onclick="myFunction()">Back</button>
                    <h3 style="margin-left:5px">'.$name->name.'</h3>
                      <div class="table-responsive checklistTable" id="checklistTable">
                        <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                        <thead style="width:200px">
                        <tr>
                          <th style="width:200px">Name</th>
                          <th style="width:200px">Action</th>
                        </tr>
                      </thead>
                      <tbody id="sampleTable" name="sampleTable">';
    
                  foreach($checklist as $list)
                  {

                      $output .= '<tr><td style="width:200px">'.$list->name.'</td><td style="width:200px"><a href="http://localhost/capstone/public/'.$list->location.'" target="_blank"><button class="btn btn-success" style="margin-left:100px">View</button></a><button class="btn btn-danger" data-toggle="modal" data-target="#deleteFile" data-fileid="'.$list->id.'" style="margin-left:10px">Delete</button></td></tr>';

                  }

    $output .= "</tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>";

    return \Response::json($output);
    }
    else{

       $output = '';

    $output .= '<div class="container" style="margin-left: 0px">
                  <div class="row">
                    <div class="col-md-12">
                    <button style="margin-left:900px" class="btn btn-primary" onclick="myFunction()">Back</button>
                    <h3 style="margin-left:5px">'.$name->name.'</h3>
                      <div class="table-responsive checklistTable" id="checklistTable">
                        <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                        <thead style="width:200px">
                        <tr>
                          <th style="width:200px">Name</th>
                          <th style="width:200px">Path</th>
                        </tr>
                      </thead>
                      <tbody id="sampleTable" name="sampleTable">';
    
                  foreach($checklist as $list)
                  {

                      $output .= '<tr><td style="width:200px">'.$list->name.'</td><td style="width:200px"><a href="http://localhost/capstone/public/'.$list->location.'">'.$list->location.'</a></td></tr>';

                  }

    $output .= "</tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>";

      return \Response::json($output);

    }
    
}

public function sampleform($id)
{
      $notes = $this->get_notes($id);

      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.pdfdoctornotes',compact('notes'));
      return $pdf->stream();
}

public function pdfdde($id)
{
      $pat = Patients::where('id',$id)->get();
      $patis = Patient_Information::with('informants')->where('patient_id',$id)->get();
      $history = Patient_History::where('patient_id',$id)->get();

      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.pdfdde',compact(['patis','history','pat']));
      return $pdf->stream();
}

public function pdfintake($id)
{
      
      $pat = Patients::where('id',$id)->get();
      $patos = Patient_Intake_Information::where('patient_id',$id)->get();

      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.pdfintake',compact(['patos','pat']));
      return $pdf->stream();
   }

public function MonitoringTool($id)
{
      $pat = Patients::where('id',$id)->with('address')->first();
      $patos = Patient_Event_List::where('patient_id',$id)->where('status', 1)->get();


      $customPaper = array(0,0,900,600);
      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.intervention',compact(['patos','pat']))->setPaper($customPaper);
      return $pdf->stream();
   }

   public function doctorsNotes($recordType,$id)
   {
      
      $pat = Patients::where('id',$id)->first();
      $notes = ProgressNotes::where(['patient_id'=>$id, 'role_type'=>$recordType])->with('userx')->get();


      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.doctors',compact(['notes', 'pat']));
      return $pdf->stream();
   }
     public function clearanceNotes($id)
   {
      
      $pat = Patients::where('id',$id)->first();
      $notes = ProgressNotes::where(['patient_id'=>$id, 'role_type'=>"Dentist"])->with('userx')->get();


      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.clearance',compact(['notes', 'pat']));
      return $pdf->stream();
  }




    public function dentalNotes($id)
   {
      
      $pat = Patients::where('id',$id)->first();
      $notes = ProgressNotes::where(['patient_id'=>$id, 'role_type'=>"Dentist"])->with('userx')->get();


      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.dental',compact(['notes', 'pat']));
      return $pdf->stream();
  }

  public function BMINotes($id){

       $pat = Patients::where('id',$id)->first();
      $notes = Bmi_records::where('patient_id', $id)->with('userxe')->get();



      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.bmi',compact(['notes', 'pat']));
      return $pdf->stream();


  }

  public function BloodSugarPDF($id){
       $pat = Patients::where('id',$id)->first();
      $notes = Blood_sugar_records::where('patient_id', $id)->with('userxe')->get();


      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.bloodsugar',compact(['notes', 'pat']));
      return $pdf->stream();


  }

   public function MedicalRecordsPDF($id){
       $pat = Patients::where('id',$id)->first();
      $notes = Medical_records::where('patient_id', $id)->with('userxe')->get();


      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.pdfmedicalrecord',compact(['notes', 'pat']));
      return $pdf->stream();


  }

public function pdfreferral($id,$rid)
{
      $refers = Refers::where('id',$rid)->where('patient_id',$id)->with('patients')->with('users')->with('accepted_bys')->get();

      $pat = Patients::where('id',$id)->get();
      $history = Patient_History::where('patient_id',$id)->get();

      $customPaper = array(0,0,900,600);
      $pdf = \App::make('dompdf.wrapper');
      $pdf = PDF::loadView('pdf.pdfreferral',compact(['refers','history','pat']))->setPaper($customPaper);
      return $pdf->stream('Patient Referral.pdf');
}

public function samplecsv(request $request)
{


    if($request->input('report') == 'Accomplishment Report'){

      $pats = Patients::where('status','Enrolled')->whereMonth('date_admitted',$request->input('month'))->whereYear('date_admitted',$request->input('year'))->get();

      $cout = count($pats);

      if(count($pats) == 0){
        $res = 1;
        return \Response::json(['res' => $res]);
      }
      else{
        $res = 0;
        return \Response::json(['res' => $res,'report' => $request->input('report'),'month' => $request->input('month'),'year' => $request->input('year'),'cout' => $cout]);
      }

    }
    elseif($request->input('report') == 'Plea Bargain'){

      $pats = Patients::where('status','Enrolled')->where(function($q){
          $q->Where('patient_type',3)
            ->orWhere('patient_type',4);})->whereMonth('date_admitted',$request->input('month'))->whereYear('date_admitted',$request->input('year'))->get();

      $cout = count($pats);

      if(count($pats) == 0){
        $res = 1;
        return \Response::json(['res' => $res]);
      }
      else{
        $res = 0;
        return \Response::json(['res' => $res,'report' => $request->input('report'),'month' => $request->input('month'),'year' => $request->input('year'),'cout' => $cout]);
      }

    }
    else{

      $pats = Patients::where('status','Enrolled')->where('department_id',$request->input('department'))->whereBetween('date_admitted',[$request->input('datefrom'),$request->input('dateto')])->get();
      $dep = Departments::where('id',$request->input('department'))->get(); 

      if(count($pats) == 0){
        $res = 1;
        return \Response::json(['res' => $res]);
      }
      else{
        $res = 0;
        return \Response::json(['res' => $res,'report' => $request->input('report'),'dep' => $request->input('department'),'datefrom' => $request->input('datefrom'),'dateto' => $request->input('dateto')]);
      }

    }
    

}

    public function downloadcsv(request $request)
   {

    if($request->input('reports') == 'Accomplishment Report'){

      $monthname = Carbon::parse($request->input('month'))->format('F');
      $yearname = Carbon::parse($request->input('year'))->format('Y');
      $monthnum = $request->input('month');

      Excel::load('resources/reports/Monthly Accomplishment Report.xlsx', function($doc) use ($request,$monthname,$yearname,$monthnum)
      {

       $style = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN)
            ),

            
            'font' => array(
              'size' => 10)

          );

       $style2 =  array(
          
          'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000')
        ),

         'font' => array(
              'color' => array('rgb' => 'ffffff'))
      );

       $style3 =  array(
          
          'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '000000')
        ),

         'font' => array(
              'color' => array('rgb' => 'ffffff')
        ),

          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
      );

      $sheet = $doc->setActiveSheetIndex(0);

      $dismiss = Dismissal_Reason::all();
      $limit = count(Dismissal_Reason::all());
      $next = 0;
      $index = 24;
      $totalall = 0;

      $reasons = array();

      /*Month and Year*/
      $sheet->mergeCells("B8:D8");
      $sheet->setCellValue('B8', 'MONTH OF: '.$monthname. ' '.$yearname);
      
      /*In-patient*/
      /*Total Target*/
      $sheet->mergeCells("H13:H14");
      $sheet->getStyle("H13")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('H13',30);

      $dep = Departments::where('department_name','In-patient')->get();
      foreach($dep as $deps)

      /*Patients from Previous month*/
      $sheet->mergeCells("I13:I14");
      $prevpat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted','<',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      $countprev = count($prevpat);
      $sheet->getStyle("I13")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I13',$countprev);

      $totalall = $countprev;

      /*Count New Admission Patients*/
      $county = 0;
      $pat = Patients::where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();

          if(count($hist) == 0){
            $county++;
          }
      }

      $sheet->getStyle("I15")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I15',$county);

      $totalall = $totalall+$county;

      /*Count Surrenderee*/
      $countsure = 0;
      $pat = Patients::where('department_id',$deps->id)->where('patient_type',2)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();

      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();

          if(count($hist) == 0){
            $countsure++;
          }
      }

      $sheet->getStyle("I16")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I16',$countsure);


      /*Count Non-surrenderee*/
      $countsur = 0;
      $pat = Patients::where('department_id',$deps->id)->where('patient_type',3)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();


      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();

          if(count($hist) == 0){
            $countsur++;
          }
      }

      $sheet->getStyle("I17")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I17',$countsur);

      /*Count Voluntary*/
      $countv = 0;
      $pat = Patients::where('department_id',$deps->id)->where('patient_type',1)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();

      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();

          if(count($hist) == 0){
            $countv++;
          }
      }

      $sheet->getStyle("I18")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I18',$countv);


      /*Count Compulsory*/
      $countc = 0;
      $pat = Patients::where('department_id',$deps->id)->where('patient_type',4)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();

      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();

          if(count($hist) == 0){
            $countc++;
          }
      }

      $sheet->getStyle("I19")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I19',$countc); 

      /*Count Re-admission Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) != 0){
          $countz++;
        }
      }

      $sheet->getStyle("I20")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I20',$countz);

      $totalall = $totalall+$countz;

      /*Display total 30*/
      $sheet->getStyle("H21")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('H21',30);

      /*Overall total 30*/
      $sheet->getStyle("I21")->getFont()->setBold(true);
      $sheet->getStyle("I21")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I21',$totalall);

      /*CALCULATE PERCENTAGE*/
      $perce = $totalall / 30;
      $percent = round((float)$perce * 100 ) . '%';
      $sheet->getStyle("J21")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('J21',$percent);


      /*Graduated Patients*/
      $pat = Patients::where('status','Graduated')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();

      $sheet->getStyle("I23")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I23',$pat);

      $totalall = $pat;

      /*Dismissal Reason*/
      $patu = Patients::where('status','Dismissed')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      $tot = 0;

       foreach($dismiss as $dis)
       {

        $sheet->mergeCells("B$index:G$index");
        $sheet->getStyle("B$index")->applyFromArray($style);
        $sheet->getStyle("H$index")->applyFromArray($style);
        $sheet->getStyle("I$index")->applyFromArray($style);
        $sheet->getStyle("J$index")->applyFromArray($style);
        $sheet->setCellValue('B'.$index, $dis->reason);

        $dismi = DB::table('dismissal__records')->where('dismissal_id',$dis->id)->join('patients','dismissal__records.patient_id','=','patients.id')->where('patients.status','Dismissed')->whereMonth('patients.date_admitted',$request->input('months'))->whereYear('patients.date_admitted',$request->input('years'))->get()->count();

        $sheet->getStyle("I$index")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('I'.$index,$dismi);

        $tot = $tot+$dismi;
        $index++;
      }

      $totalall = $tot+$totalall;

      /*Target*/
      $sheet->mergeCells("H29:H30");
      $sheet->getStyle("H29")->getFont()->setBold(true);
      $sheet->getStyle("H29")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('H29',30);

      /*Total*/
      $sheet->getStyle("I28")->getFont()->setBold(true);
      $sheet->getStyle("I28")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I28',$totalall);

      /*Total All*/
      $tota = $totalall+$countprev;
      $sheet->getStyle("I29")->getFont()->setBold(true);
      $sheet->getStyle("I29")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I29',$tota);

      /*Percent*/
      $perce = $tota / 30;
      $percent = round((float)$perce * 100 ) . '%';
      $sheet->mergeCells("J29:J30");
      $sheet->getStyle("J29")->getFont()->setBold(true);
      $sheet->getStyle("J29")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('J29',$percent);



      $next = $limit+24;

      $sheet->mergeCells("B$next:G$next");
      $sheet->getStyle("B$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("H$next")->applyFromArray($style);
      $sheet->getStyle("I$next")->applyFromArray($style);
      $sheet->getStyle("J$next")->applyFromArray($style);
      $sheet->setCellValue('B'.$next, 'TOTAL');

      $nextz = $next+1;

      $sheet->mergeCells("B$nextz:G$nextz");
      $sheet->getStyle("B$nextz")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("H$nextz")->applyFromArray($style);
      $sheet->getStyle("I$nextz")->applyFromArray($style);
      $sheet->getStyle("J$nextz")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextz, 'TOTAL NUMBER OF RESIDENTS/IN-PATIENTS MANAGED');


      $nextx = $nextz+1;

      $sheet->mergeCells("B$nextx:G$nextx");
      $sheet->getStyle("B$nextx")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->mergeCells("H$nextz:H$nextx");
      $sheet->getStyle("H$nextx")->applyFromArray($style);
      $sheet->mergeCells("I$nextz:I$nextx");
      $sheet->getStyle("I$nextx")->applyFromArray($style);
      $sheet->mergeCells("J$nextz:J$nextx");
      $sheet->getStyle("J$nextx")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextx, '(TOTAL CENSUS BY THE END OF THE MONTH)');

      /*Out-patient*/
      $dep = Departments::where('department_name','Out-patient')->get();
      foreach($dep as $deps)
      $totalall = 0;

      $nextv = $nextx+1;

      $sheet->mergeCells("B$nextv:J$nextv");
      $sheet->getStyle("B$nextv")->applyFromArray($style2)->getFont()->setSize(10);
      $sheet->setCellValue('B'.$nextv, 'OUTPATIENT CARE SERVICES');

      $nextb = $nextv+1;

      $sheet->mergeCells("B$nextb:G$nextb");
      $sheet->getStyle("B$nextb")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextb")->applyFromArray($style);
      $sheet->getStyle("I$nextb")->applyFromArray($style);
      $sheet->getStyle("J$nextb")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextb, 'NUMBER OF OUTPATIENT CASES (New)');
      
      /*Count New Admission Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) == 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextb")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextb,$countz);

      $totalall = $countz;


      $nextb = $nextb+1;

      $sheet->mergeCells("B$nextb:G$nextb");
      $sheet->getStyle("B$nextb")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextb")->applyFromArray($style);
      $sheet->getStyle("I$nextb")->applyFromArray($style);
      $sheet->getStyle("J$nextb")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextb, 'NUMBER OF OUTPATIENT CASES (Old)');

      /*Count Old Admission Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) != 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextb")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextb,$countz);

      $totalall = $totalall+$countz;

      $nextn = $nextb+1;

      $sheet->mergeCells("B$nextn:G$nextn");
      $sheet->getStyle("B$nextn")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextn")->applyFromArray($style);
      $sheet->getStyle("I$nextn")->applyFromArray($style);
      $sheet->getStyle("J$nextn")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextn, 'NUMBER OF OUTPATIENT CASES (TR) (POST-RESIDENTIAL)');

      /*Count Post-Residential Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('from_dep',1)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) != 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextn")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextn,$countz);

      $totalall = $totalall+$countz;

      $nextm = $nextn+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'GRADUATES');

      /*Count Graduate Patients*/
      $pat = Patients::where('status','Graduated')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$pat);

      $totalall = $totalall+$pat;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'DISMISSED');

      /*Count Graduate Patients*/
      $pat = Patients::where('status','Dismissed')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$pat);

      $totalall = $totalall+$pat;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'TOTAL NUMBER OF OUT-PATIENTS MANAGED');
      $sheet->getStyle("H$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('H'.$nextm, 30);
      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->getStyle("I$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('I'.$nextm, $totalall);

      /*Percent*/
      $perce = $totalall / 30;
      $percent = round((float)$perce * 100 ) . '%';
      $sheet->getStyle("J$nextm")->getFont()->setBold(true);
      $sheet->getStyle("J$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('J'.$nextm,$percent);


      /*Aftercare*/
      $dep = Departments::where('department_name','Aftercare')->get();
      foreach($dep as $deps)
      $totalall = 0;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:J$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style2)->getFont()->setSize(10);
      $sheet->setCellValue('B'.$nextm, 'AFTERCARE SERVICES');

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'NEW CLIENTS');
      
      /*Count New Admission Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) == 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$countz);

      $totalall = $countz;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'ACTIVE OLD CLIENTS');
      
      /*Count ACTIVE OLD Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->where('inactive',NULL)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) != 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$countz);

      $totalall = $totalall+$countz;


      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'OLD CLIENTS');
      
      /*Count ACTIVE OLD Patients*/
      $countz = 0;
      $pat = Patients::where('status','Enrolled')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();
      
      foreach($pat as $paty)
      {
        $hist = Patient_History::where('patient_id',$paty->id)->where('to_dep',$deps->id)->where(function($q){
          $q->Where('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');})->get();
        if(count($hist) != 0){
          $countz++;
        }
      }

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$countz);

      $totalall = $totalall+$countz;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'GRADUATES');
      
      /*Count Graduated Patients*/
      $countz = 0;
      $pat = Patients::where('status','Graduated')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$pat);

      $totalall = $totalall+$pat;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'DISMISSED');
      
      /*Count Dismissed Patients*/
      $countz = 0;
      $pat = Patients::where('status','Dismissed')->where('department_id',$deps->id)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();

      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$nextm,$pat);

      $totalall = $totalall+$pat;

      $nextm = $nextm+1;

      $sheet->mergeCells("B$nextm:G$nextm");
      $sheet->getStyle("B$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("H$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("I$nextm")->applyFromArray($style);
      $sheet->getStyle("J$nextm")->applyFromArray($style);
      $sheet->setCellValue('B'.$nextm, 'TOTAL NUMBER OF AFTER-CARE CLIENTS MANAGED');
      $sheet->getStyle("H$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('H'.$nextm, 30);
      $sheet->getStyle("I$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->getStyle("I$nextm")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('I'.$nextm, $totalall);

      /*Percent*/
      $perce = $totalall / 30;
      $percent = round((float)$perce * 100 ) . '%';
      $sheet->getStyle("J$nextm")->getFont()->setBold(true);
      $sheet->getStyle("J$nextm")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('J'.$nextm,$percent);


      $nextk = $nextm+8;
      
      $sheet->mergeCells("B$nextk:J$nextk");
      $sheet->getStyle("B$nextk")->applyFromArray($style2)->getFont()->setSize(10);
      $sheet->setCellValue('B'.$nextk, 'AFTER-CARE SERVICES');

      $nextp = $nextk+1;

      $sheet->mergeCells("B$nextp:J$nextp");
      $sheet->getStyle("B$nextp")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('B'.$nextp, 'II. SOCIAL SERVICES');

      $nextl = $nextp+1;

      $sheet->mergeCells("B$nextl:D$nextl");
      $sheet->mergeCells("E$nextl:F$nextl");
      $sheet->mergeCells("G$nextl:H$nextl");
      $sheet->mergeCells("I$nextl:J$nextl");
      $sheet->getStyle("B$nextl")->applyFromArray($style3);
      $sheet->getStyle("E$nextl")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->getStyle("G$nextl")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->getStyle("I$nextl")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->setCellValue('E'.$nextl, 'TARGET');
      $sheet->setCellValue('G'.$nextl, 'ACTUAL');
      $sheet->setCellValue('I'.$nextl, '%');

      $nexto = $nextl+1;
      $services = Services::where('inactive',0)->where('parent',7)->get();
      $index = $nexto;
      $totalall = 0;

      foreach($services as $servs)
      {
        $sheet->mergeCells("B$index:D$index");
        $sheet->mergeCells("E$index:F$index");
        $sheet->mergeCells("G$index:H$index");
        $sheet->mergeCells("I$index:J$index");
        $sheet->getStyle("B$index")->applyFromArray($style);
        $sheet->getStyle("E$index")->applyFromArray($style);
        $sheet->getStyle("G$index")->applyFromArray($style);
        $sheet->getStyle("I$index")->applyFromArray($style);
        $sheet->setCellValue('B'.$index, $servs->name);


        $patsev = Patients::where('status','Enrolled')->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('progress_notes','patients.id','=','progress_notes.patient_id')->where('progress_notes.service_id',$servs->id)->get()->count();

        $sheet->getStyle('E'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('E'.$index, 2);
        $sheet->getStyle('G'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('G'.$index, $patsev);

        $perce = $patsev / 2;
        $percent = round((float)$perce * 100 ) . '%';
        $sheet->getStyle("I$index")->getFont()->setBold(true);
        $sheet->setCellValue('I'.$index,$percent);

        $index++;
      }

      $totalall = $patsev;

      $next = $nexto+1;

      $sheet->mergeCells("B$next:D$next");
      $sheet->mergeCells("E$next:F$next");
      $sheet->mergeCells("G$next:H$next");
      $sheet->mergeCells("I$next:J$next");
      $sheet->getStyle("B$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("E$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("G$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("I$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle('E'.$next)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->getStyle('G'.$next)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->getStyle('I'.$next)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('E'.$next, 8);
      $sheet->setCellValue('G'.$next, $patsev);
      $sheet->setCellValue('B'.$next, 'TOTAL');

      $perce = $totalall / 8;
      $percent = round((float)$perce * 100 ) . '%';
      $sheet->getStyle("I$next")->getFont()->setBold(true);
      $sheet->setCellValue('I'.$next,$percent);

      $next = $next+1;

      $sheet->mergeCells("B$next:J$next");
      $sheet->getStyle("B$next")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('B'.$next, 'III. REFERRAL SERVICES');

      $next = $next+1;

      $sheet->mergeCells("B$next:D$next");
      $sheet->mergeCells("E$next:F$next");
      $sheet->mergeCells("G$next:H$next");
      $sheet->mergeCells("I$next:J$next");
      $sheet->getStyle("B$next")->applyFromArray($style3);
      $sheet->getStyle("E$next")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->getStyle("G$next")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->getStyle("I$next")->applyFromArray($style3)->getFont()->setSize(10);
      $sheet->setCellValue('E'.$next, 'RESIDENTIAL');
      $sheet->setCellValue('G'.$next, 'OUT-PATIENT');
      $sheet->setCellValue('I'.$next, 'AFTERCARE');


      $service = Services::where('inactive',0)->where('parent',0)->get();
      $limit = count($service);
      $index = $next+1;
      $totalr = 0;
      $totalo = 0;
      $totali = 0;

      foreach($service as $serv)
      {
        $sheet->mergeCells("B$index:D$index");
        $sheet->mergeCells("E$index:F$index");
        $sheet->mergeCells("G$index:H$index");
        $sheet->mergeCells("I$index:J$index");
        $sheet->getStyle("B$index")->applyFromArray($style);
        $sheet->getStyle("E$index")->applyFromArray($style);
        $sheet->getStyle("G$index")->applyFromArray($style);
        $sheet->getStyle("I$index")->applyFromArray($style);
        $sheet->setCellValue('B'.$index, $serv->name);

        $patsevr = Patients::where('status','Enrolled')->where('department_id',1)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('progress_notes','patients.id','=','progress_notes.patient_id')->where('progress_notes.service_id',$serv->id)->get()->count();

        $sheet->getStyle('E'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('E'.$index, $patsevr);

        $totalr = $totalr+$patsevr;

        $patsevo = Patients::where('status','Enrolled')->where('department_id',2)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('progress_notes','patients.id','=','progress_notes.patient_id')->where('progress_notes.service_id',$serv->id)->get()->count();

        $sheet->getStyle('G'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('G'.$index, $patsevo);

        $totalo = $totalo+$patsevo;

        $patsevi = Patients::where('status','Enrolled')->where('department_id',3)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('progress_notes','patients.id','=','progress_notes.patient_id')->where('progress_notes.service_id',$serv->id)->get()->count();

        $sheet->getStyle('I'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('I'.$index, $patsevi);

        $totali = $totali+$patsevi;

        $index++;
      }

      $index = $index;

      $sheet->mergeCells("B$index:D$index");
      $sheet->mergeCells("E$index:F$index");
      $sheet->mergeCells("G$index:H$index");
      $sheet->mergeCells("I$index:J$index");
      $sheet->getStyle("E$index")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("G$index")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("I$index")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("B$index")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('B'.$index, 'TOTAL');
      $sheet->getStyle('E'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('E'.$index, $totalr);
      $sheet->getStyle('G'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('G'.$index, $totalo);
      $sheet->getStyle('I'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
      $sheet->setCellValue('I'.$index, $totali);

      $index = $index+2;

      $sheet->mergeCells("B$index:D$index");
      $sheet->mergeCells("H$index:J$index");
      $sheet->setCellValue('B'.$index,'Prepared By: ');
      $sheet->setCellValue('H'.$index,'Approved By: ');

      $index = $index+2;

      $sheet->mergeCells("B$index:D$index");
      $sheet->mergeCells("H$index:J$index");
      $sheet->getStyle("B$index")->getFont()->setBold(true)->setSize(10);
      $sheet->getStyle("H$index")->getFont()->setBold(true)->setSize(10);
      $sheet->setCellValue('B'.$index,'STEPHEN CHRISTIAN L. DE LA SERNA');
      $sheet->setCellValue('H'.$index,'JASMIN T. PERALTA, MD, MPH, DPCAM, FPSMSI');

      $index = $index+1;

      $sheet->mergeCells("B$index:D$index");
      $sheet->mergeCells("H$index:J$index");
      $sheet->getStyle("B$index")->getFont()->setSize(10);
      $sheet->getStyle("H$index")->getFont()->setSize(10);
      $sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
      $sheet->getStyle('H'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
      $sheet->setCellValue('B'.$index,'Nurse II');
      $sheet->setCellValue('H'.$index,'Chief of Hospital II');

      $index = $index+1;

      $sheet->mergeCells("B$index:D$index");
      $sheet->mergeCells("H$index:J$index");
      $sheet->getStyle("B$index")->getFont()->setSize(10);
      $sheet->getStyle("H$index")->getFont()->setSize(10);
      $sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
      $sheet->getStyle('H'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
      $sheet->setCellValue('B'.$index,'DOH TRC Cebu City');
      $sheet->setCellValue('H'.$index,'DOH TRC Cebu City');

      })->setFileName($monthname.' '.$yearname.' Accomplishment Report')->download('xlsx');

    }

    else if($request->input('reports') == 'Profile Report')
    {

    $pats = Patients::where('status','Enrolled')->where('department_id',$request->input('departments'))->whereBetween('date_admitted',[$request->input('datefroms'),$request->input('datetos')])->get();
    $dep = Departments::where('id',$request->input('departments'))->get();

    
    $patient = array();
    $total = count($pats);
    $index = 8;
    $no = 1;

    foreach($dep as $deps)

    foreach($pats as $pat)
    {
      $patient[] = $pat;
    }


      $depname = $deps->department_name;
      $datefrom = Carbon::parse($request->input('datefroms'))->format('d F Y');
      $dateto = Carbon::parse($request->input('datetos'))->format('d F Y');

       Excel::load('resources/reports/Patient Profile Report.xlsx', function($doc) use ($request,$datefrom,$dateto,$depname,$pat,$index,$total,$patient,$no)
      {

        $style2= array(

            'font' => array(
              'size' => 11,
                'bold' => true)

          );

         $style3= array(

            'font' => array(
              'size' => 9)

          );

        $start = 9;
        $next = $start+$total;
        $nexts = $next+1;
        $nextz = $nexts+1;
        $nextx = $nextz+1;

        $sheet = $doc->setActiveSheetIndex(0);
        $sheet->setCellValue('C4', $depname.' Enrollment  Profile as of '.$datefrom.' - '.$dateto);
        $sheet->mergeCells("C$next:D$next");
        $sheet->getStyle("C$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('C'.$next, 'Prepared by:');
        $sheet->mergeCells("E$next:F$next");
        $sheet->getStyle("E$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('E'.$next, 'Noted by:');
        $sheet->getStyle("K$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('K'.$next, 'Recommending Approval:');
        $sheet->getStyle("P$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('P'.$next, 'Approved by:');

        $sheet->getStyle("C$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C$nexts")->applyFromArray($style2);
        $sheet->setCellValue('C'.$nexts, 'LOVENA G. ALEGRE');

        $sheet->mergeCells("E$nexts:I$nexts");
        $sheet->getStyle("E$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("E$nexts")->applyFromArray($style2);
        $sheet->setCellValue('E'.$nexts, 'ANACLETO CLENT L. BANAAY JR., MD, MPM');

        $sheet->getStyle("K$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("K$nexts")->applyFromArray($style2);
        $sheet->setCellValue('K'.$nexts, 'JOSEFEL A. CHUA, RSW, MSW, MPA');

        $sheet->getStyle("P$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("P$nexts")->applyFromArray($style2);
        $sheet->setCellValue('P'.$nexts, 'JASMIN T. PERALTA, MD, MPH, DPCAM, FPSMSI');

        $sheet->mergeCells("C$nextz:D$nextz");
        $sheet->getStyle("C$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C$nextz")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("C$nextz")->applyFromArray($style3);
        $sheet->setCellValue('C'.$nextz, 'Social Welfare Officer I ');

        $sheet->getRowDimension("$nextz")->setRowHeight(15);
        $sheet->mergeCells("E$nextz:I$nextz");
        $sheet->getStyle("E$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("E$nextz")->applyFromArray($style3);
        $sheet->setCellValue('E'.$nextz, 'Medical Specialist I');

        $sheet->mergeCells("K$nextz:M$nextz");
        $sheet->getStyle("K$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("K$nextz")->applyFromArray($style3);
        $sheet->setCellValue('K'.$nextz, 'Chief Health Program Officer');

        $sheet->mergeCells("P$nextz:R$nextz");
        $sheet->getStyle("P$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("P$nextz")->applyFromArray($style3);
        $sheet->setCellValue('P'.$nextz, 'Chief of Hospital II');

        $sheet->mergeCells("E$nextx:I$nextx");
        $sheet->getStyle("E$nextx")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("E$nextx")->applyFromArray($style3);
        $sheet->setCellValue('E'.$nextx, 'Section Head – OPD and Aftercare Program');

        $sheet->mergeCells("P$nextx:R$nextx");
        $sheet->getStyle("P$nextx")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("P$nextx")->applyFromArray($style3);
        $sheet->setCellValue('P'.$nextx, 'DOH TRC Cebu City');



        for($count=0;$count<$total;$count++)
      {

        $style= array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN)
            ),

            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER),

            'font' => array(
              'size' => 10)

          );
        
        $sheet->getStyle("C$index:R$index")->applyFromArray($style);
        $sheet->mergeCells("D$index:E$index");
        $sheet->mergeCells("F$index:G$index");
        $sheet->mergeCells("J$index:K$index");
        $sheet->mergeCells("M$index:N$index");
        $sheet->mergeCells("P6:Q6"); 
        $sheet->mergeCells("P7:Q7");
        $sheet->mergeCells("P$index:Q$index");
        $sheet->getStyle('H'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('J'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('P'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('Q'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('O'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('C'.$index, $no);
        $sheet->setCellValue('D'.$index, $patient[$count]->fname.' '.$patient[$count]->mname.' '.$patient[$count]->lname);
        $sheet->setCellValue('F'.$index, Carbon::parse($patient[$count]->date_admitted)->format('m/d/Y'));
        $sheet->setCellValue('H'.$index, $patient[$count]->cstatus->name);
        $sheet->setCellValue('I'.$index, Carbon::parse($patient[$count]->birthdate)->age);
        $sheet->setCellValue('J'.$index, $patient[$count]->address->street.' '.$patient[$count]->address->barangay.' '.$patient[$count]->address->city);
        $sheet->setCellValue('L'.$index, $patient[$count]->religion);

        $patos = Patient_Intake_Information::where('patient_id',$patient[$count]->id)->get();
        $patis = Patient_Information::where('patient_id',$patient[$count]->id)->get();
        $history = Patient_History::where('patient_id',$patient[$count]->id)->where(function($q){
          $q->where('type','Enrolled')
            ->orWhere('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');

        })->where('to_dep',$request->input('departments'))->count();
      
        $sheet->setCellValue('O'.$index, $patient[$count]->type->case_name);
      
      foreach($patos as $pats)
      foreach($patis as $patss)

      if($patis != '[]'){
        $sheet->setCellValue('M'.$index, $pats->eduatain->name);
        $sheet->setCellValue('P'.$index, $patss->h_drug_abuse);
      }

        $sheet->setCellValue('R'.$index, NumConvert::numberOrdinal($history).' Time');
        $index++;
        $no++;
      }

      })->setFileName($datefrom.' - '.$dateto.' '.$depname.' Profile Report')->download('xlsx');


  }

  else if($request->input('reports') == 'Status Report'){

    $pats = Patients::where('status','Enrolled')->where('department_id',$request->input('departments'))->whereBetween('date_admitted',[$request->input('datefroms'),$request->input('datetos')])->get();
    $dep = Departments::where('id',$request->input('departments'))->get();

    $patient = array();
    $total = count($pats);
    $index = 4;
    $no = 1;

    foreach($dep as $deps)

    foreach($pats as $pat)
    {
      $patient[] = $pat;
    }

    $depname = $deps->department_name;
    $datefrom = Carbon::parse($request->input('datefroms'))->format('d F Y');
    $dateto = Carbon::parse($request->input('datetos'))->format('d F Y');

    Excel::load('resources/reports/Aftercare Status Report.xlsx', function($doc) use ($request,$datefrom,$dateto,$depname,$pat,$no,$patient,$total,$index)
    {

      $sheet = $doc->setActiveSheetIndex(0);
      $sheet->setCellValue('B1','Aftercare Status as of '.$datefrom.' - '.$dateto);

      for($count=0;$count<$total;$count++)
      {

        $style= array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN)
            ),

            'alignment' => array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER),

            'font' => array(
              'size' => 10)

          );

        $sheet->getStyle("B$index:Q$index")->applyFromArray($style);
        $sheet->setCellValue('B'.$index,$no);
        $sheet->getStyle('C'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('C'.$index,$patient[$count]->fname.' '.$patient[$count]->mname.'. '.$patient[$count]->lname);
        $sheet->getStyle('D'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('D'.$index,Carbon::parse($patient[$count]->birthdate)->age);
        $sheet->getStyle('E'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('E'.$index,$patient[$count]->cstatus->name);
        $sheet->getStyle('F'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('F'.$index,$patient[$count]->address->street.' '.$patient[$count]->address->barangay.' '.$patient[$count]->address->city);
        $sheet->getStyle('G'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('G'.$index,$patient[$count]->contact);
        $sheet->getStyle('H'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('H'.$index,$patient[$count]->admission_no);
        $sheet->getStyle('H'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('H'.$index,$patient[$count]->admission_no);

        $release = Patient_History::where('patient_id',$patient[$count]->id)->where(function ($release) {
          $release->where('type','=','Dismissed')
           ->orWhere('type','=','Enrolled from Transfer')
           ->orWhere('type','=','Graduated');
          })->latest('created_at')->first();

        $sheet->getStyle('I'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('I'.$index,$release->date);

        $release = Patient_History::where('patient_id',$patient[$count]->id)->where('to_dep',3)->where(function ($release) {
          $release->where('type','=','Enrolled')
           ->orWhere('type','=','Enrolled from Transfer')
           ->orWhere('type','=','Re-enrolled');
          })->latest('created_at')->first();

        $sheet->getStyle('J'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('J'.$index,$release->date);

        $session = Patient_Event_List::where('patient_id',$patient[$count]->id)->where('status',1)->latest('created_at')->first();

        if($session){
          $sheet->getStyle('K'.$index)->getAlignment()->setWrapText(true);
          $sheet->setCellValue('K'.$index,$session->date);
        }
        else{
          $sheet->getStyle('K'.$index)->getAlignment()->setWrapText(true);
          $sheet->setCellValue('K'.$index,'none');
        }

        $sheet->getStyle('L'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('L'.$index,$patient[$count]->religion);

        $patos = Patient_Intake_Information::where('patient_id',$patient[$count]->id)->get();
        $patis = Patient_Information::where('patient_id',$patient[$count]->id)->get();
        $history = Patient_History::where('patient_id',$patient[$count]->id)->where(function($q){
          $q->where('type','Enrolled')
            ->orWhere('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');

        })->where('to_dep',$request->input('departments'))->count();

        foreach($patos as $pats)
        
      if($patos){ 
        $sheet->getStyle('M'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('M'.$index, $pats->eduatain->name);
      }

      if($patis){
        foreach($patis as $patss)
        $sheet->getStyle('N'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('N'.$index, $patss->h_drug_abuse);
      }

        $sheet->getStyle('O'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('O'.$index, NumConvert::numberOrdinal($history).' Time');

        $sheet->getStyle('P'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('P'.$index, $patient[$count]->type->case_name);

        

        $index++;
        $no++;
     }

    })->setFileName($datefrom.' - '.$dateto.' '.$depname.' Aftercare Status Report')->download('xlsx');
  }
  elseif($request->input('reports') == 'Plea Bargain'){

      $monthname = Carbon::parse($request->input('month'))->format('F');
      $yearname = Carbon::parse($request->input('year'))->format('Y');
      $monthnum = $request->input('month');

      Excel::load('resources/reports/Plea Bargaining Report.xlsx', function($doc) use ($request,$monthname,$yearname,$monthnum)
      {

         $style = array(
            'borders' => array(
              'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN)
            ),

            
            'font' => array(
              'size' => 10)

          );


         $sheet = $doc->setActiveSheetIndex(0);
         $sheet->setCellValue('A10', 'FOR THE MONTH OF: '.$monthname. ' '.$yearname);

         $sheet->mergeCells("B12:H12");
         $sheet->getStyle("B12")->applyFromArray($style);
         $sheet->getStyle("I12")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
         $sheet->setCellValue('I12', 'TOTAL');
         $sheet->mergeCells("B13:H13");
         $sheet->getStyle("B13")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
         $sheet->setCellValue('B13', '1. TOTAL CLIENTS SERVED');

         /*Total Number of Plea Bargains*/
         $pats = Patients::where('status','Enrolled')->where(function($q){
          $q->Where('patient_type',3)
            ->orWhere('patient_type',4);})->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();  

         $sheet->getStyle("I13")->applyFromArray($style)->getFont()->setBold(true)->setSize(10);
         $sheet->getStyle("I13")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
         $sheet->setCellValue('I13', count($pats));

         $sheet->mergeCells("B14:H14");
         $sheet->getStyle("B14")->applyFromArray($style);
         $sheet->getStyle("I14")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->getStyle("B14")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->setCellValue('B14', '    1.a Walked in Plea Bargain');

         /*Total Number of Walk-in Plea Bargains*/
         $pats = Patients::where('status','Enrolled')->where('patient_type',3)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();  

         $sheet->getStyle("I14")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->getStyle("I14")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
         $sheet->setCellValue('I14', $pats);

         $sheet->mergeCells("B15:H15");
         $sheet->getStyle("B15")->applyFromArray($style);
         $sheet->getStyle("I15")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->getStyle("B15")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->setCellValue('B15', '    1.b Escorted Plea Bargain');

         /*Total Number of Walk-in Plea Bargains*/
         $pat = Patients::where('status','Enrolled')->where('patient_type',4)->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get()->count();  

         $sheet->getStyle("I15")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->getStyle("I15")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
         $sheet->setCellValue('I15',$pat);

         $sheet->mergeCells("B16:I16");
         $sheet->getStyle("B16")->applyFromArray($style);

         $sheet->mergeCells("B17:H17");
         $sheet->getStyle("B17")->applyFromArray($style)->getFont()->setBold(true);
         $sheet->getStyle("I17")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->getStyle("B17")->applyFromArray($style)->getFont()->setSize(10);
         $sheet->setCellValue('B17', '2. DRUG DEPENDENCY EXAMINATION REPORT');

         /*Total Number DDE Patients*/
         $countz = 0;
         $pats = Patients::where('status','Enrolled')->where(function($q){
          $q->Where('patient_type',3)
            ->orWhere('patient_type',4);})->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->get();

         foreach($pats as $paty)
         {
            $patis = Patient_Information::where('patient_id',$paty->id)->get();
            if(count($patis) != 0){
              $countz++;
            }
         }

        $sheet->getStyle("I17")->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->getStyle("I17")->applyFromArray($style)->getFont()->setBold(true);
        $sheet->setCellValue('I17',$countz);

        $index = 18;

        $dabused = Drugs_Abused::where('flag',NULL)->get();

        foreach($dabused as $dab)
        {

          $sheet->mergeCells("B$index:H$index");
          $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont();
          $sheet->getStyle('I'.$index)->applyFromArray($style)->getFont()->setSize(10);
          $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont()->setSize(10);
          $sheet->setCellValue('B'.$index,'   '.$dab->name);

          $dde = Patients::where('status','Enrolled')->where(function($q){
          $q->Where('patient_type',3)
            ->orWhere('patient_type',4);})->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('patient__informations','patients.id','=','patient__informations.patient_id')->join('drugs__abuseds','patient__informations.drugs_abused','=','drugs__abuseds.id')->where('drugs__abuseds.id',$dab->id)->get()->count();


          $sheet->getStyle('I'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
          $sheet->setCellValue('I'.$index,$dde);

          $index++;

        }

        $sheet->mergeCells("B$index:I$index");
        $sheet->getStyle('B'.$index)->applyFromArray($style);

        $index = $index+1;

        $sheet->mergeCells("B$index:H$index");
        $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont()->setBold(true);
        $sheet->getStyle('I'.$index)->applyFromArray($style)->getFont()->setSize(10);
        $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont()->setSize(10);
        $sheet->setCellValue('B'.$index, 'BJMP ASSISTED');

        $jail = City_Jails::where('flag',NULL)->get();

        $index = $index+1;

        $tut = 0;
        foreach($jail as $jails)
        {

          $sheet->mergeCells("B$index:H$index");
          $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont();
          $sheet->getStyle('I'.$index)->applyFromArray($style)->getFont()->setSize(10);
          $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont()->setSize(10);
          $sheet->setCellValue('B'.$index,'   '.$jails->name);

          $jay = Patients::where('status','Enrolled')->where(function($q){
          $q->Where('patient_type',3)
            ->orWhere('patient_type',4);})->whereMonth('date_admitted',$request->input('months'))->whereYear('date_admitted',$request->input('years'))->join('city__jails','patients.jail','=','city__jails.id')->where('city__jails.id',$jails->id)->get()->count();

          $sheet->getStyle('I'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
          $sheet->setCellValue('I'.$index,$jay);

          $tut = $tut+$jay;
          $index++;
        }

        $sheet->mergeCells("B$index:H$index");
        $sheet->getStyle('B'.$index)->applyFromArray($style)->getFont()->setBold(true);
        $sheet->getStyle('I'.$index)->applyFromArray($style)->getFont()->setSize(10)->setBold(true);
        $sheet->getStyle('I'.$index)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
        $sheet->setCellValue('B'.$index, 'TOTAL');
        $sheet->setCellValue('I'.$index, $tut);

        $index = $index+2;

        $sheet->mergeCells("B$index:C$index");   
        $sheet->setCellValue('B'.$index,'Prepared By: ');
        $sheet->mergeCells("F$index:H$index");   
        $sheet->setCellValue('F'.$index,'Recommending Approval: ');

        $index = $index+2;

        $sheet->mergeCells("B$index:D$index");   
        $sheet->getStyle('B'.$index)->getFont()->setBold(true);
        $sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue('B'.$index,'VINCENT S. RICAPLAZA');
        $sheet->mergeCells("F$index:I$index");
        $sheet->getStyle('F'.$index)->getFont()->setBold(true);
        $sheet->getStyle('F'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);  
        $sheet->setCellValue('F'.$index,'JOSEFEL A. CHUA, RSW, MSW, MPA');

        $index = $index+1;

        $sheet->mergeCells("B$index:D$index");   
        $sheet->getStyle('B'.$index)->getFont()->setSize(9);
        $sheet->getStyle('B'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue('B'.$index,'NATT II');
        $sheet->mergeCells("F$index:I$index");
        $sheet->getStyle('F'.$index)->getFont()->setSize(9);
         $sheet->getStyle('F'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);  
        $sheet->setCellValue('F'.$index,'Chief Health Program Officer');

        $index = $index+2;

        $sheet->mergeCells("B$index:C$index");   
        $sheet->setCellValue('B'.$index,'Date: ____________________');
        $sheet->mergeCells("F$index:H$index");   
        $sheet->setCellValue('F'.$index,'Date: ____________________');

        $index = $index+2;

        $sheet->mergeCells("C$index:D$index");   
        $sheet->setCellValue('D'.$index,'Approved by: ');

        $index = $index+1;

        $sheet->mergeCells("C$index:G$index");
        $sheet->getStyle('C'.$index)->getFont()->setBold(true);
        $sheet->getStyle('C'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);   
        $sheet->setCellValue('C'.$index,'JASMIN T. PERALTA, MD, MPH, DPCAM,FPSMSI');

        $index = $index+1;

        $sheet->mergeCells("D$index:F$index");
        $sheet->getStyle('D'.$index)->getFont()->setSize(9);
        $sheet->getStyle('D'.$index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);  
        $sheet->setCellValue('D'.$index,'OIC Chief Of Hospital');

        $index = $index+2;

        $sheet->mergeCells("D$index:F$index");   
        $sheet->setCellValue('D'.$index,'Date: ____________________');


      })->setFileName($monthname.' '.$yearname.' Plea Bargaining Report')->download('xlsx');
    }
}


    public function get_notes($id)
   {
     $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();

     return $notes;
   }
}
