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
use Calendar;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Events;
use App\Patients;
use App\Interventions;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Notifications;
use App\Charts\PatientChart;
use Hash;
use Charts;
use Session;

class CalendarController extends Controller
{
   public function showCalen()
   {


       $roles = User_roles::all();
       $deps = Departments::all();
       $users = Users::find(Auth::user()->id);
       $transfer = Transfer_Requests::all();
      

       return view('calendar.viewCalendar')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);;

   }

   public function get_Events()
   {
          $events = Events::all()->toArray();

          return response()->json($events);

   }

   public function get_Deps1()
   {
          $deps = Departments::all()->pluck('department_name')->toArray();

          return response()->json($deps);

   }

   public function getcount_Deps1()
   {
          $deps = Patients::where('department_id',1)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }


public function chart()
    {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $userss = Patients::where('department_id', Auth::user()->department)->get();

      date_default_timezone_set('Asia/Singapore');

      $patients1 = Patients::where('status','Graduated')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $pat = count($patients1);

      $patients2 = Patients::where('status','Dismissed')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patz = count($patients2);

      $patients3 = Patients::where('status','Enrolled')->whereRaw('DATE(updated_at) = CURRENT_DATE')->get();

      $patx = count($patients3);

      $today_users = Patients::whereDate('created_at', today())->count();
      $yesterday_users = Patients::whereDate('created_at', today()->subDays(1))->count();
      $users_2_days_ago = Patients::whereDate('created_at', today()->subDays(2))->count();

      $chart = new PatientChart;
      $chart->labels(['2 days ago', 'Yesterday', 'Today']);
      $chart->dataset('My dataset', 'line', [$users_2_days_ago, $yesterday_users, $today_users]);

      return view('chart', compact('chart'))->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('pat',$pat)->with('patx',$patx)->with('patz',$patz);

    }

   // public function chart()
   // {
    //  $users = Patients::where(DB::raw("(DATE_FORMAT(created_at,'%m'))"),date('m'))
     //       ->get();
      //  $chart = Charts::database($users, 'bar', 'highcharts')
       //     ->title("Monthly new Register Users")
        //    ->elementLabel("Total Users")
         //   ->dimensions(1000, 500)
          //  ->responsive(false)
           // ->groupByMonth(date('Y'), true);
           // 
        //return view('chart',compact('chart'));
    //}

    public function getcount_Deps2()
   {
          $deps = Patients::where('department_id',2)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }

    public function getcount_Deps3()
   {
          $deps = Patients::where('department_id',3)->where('status','Enrolled')->get();

          $depz = count($deps);

          return response()->json($depz);

   }

    public function create_event(){

       $roles = User_roles::all();
       $deps = Departments::all();
       $patients = Patients::all();
       $interven = Interventions::all();
       $users = Users::find(Auth::user()->id);
      // $pat = Patients::select(DB::raw("CONCAT('fname','lname') AS display_name"),'id')->get()->pluck('display_name','id');



       return view('calendar.createEvent')->with('roles',$roles)->with('deps',$deps)->with('interven', $interven)->with('patients', $patients)->with('users',$users);
      
    }

    public function add_event(Request $request){

        $input = $request->all();    

        //$patients = $request->input('patient-select');

        $event = new Events([
        'title' => $request->input('title'),
        'venue' => $request->input('venue'),
        'start' => $request->input('event_date')." ".date("H:m:s", strtotime($request->input('start_time'))),
        'end' => $request->input('event_date')." ".date("H:m:s", strtotime($request->input('end_time')))
        ]);

      $event->save();

      Session::flash('alert-class', 'success'); 
      flash('Schedule Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);

        return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users);

    }

    public function viewevent($id)
    {
        $evt = Events::where('id',$id)->get();
        $roles = User_roles::all(); 
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);

        return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('evt' ,$evt)->with('users',$users);

    }

}
