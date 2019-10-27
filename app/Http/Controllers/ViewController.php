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
use App\City_Jails;
use App\Patients;
use App\Patient_Intake_Information;
use App\Patient_Information;
use App\Patient_History;
use App\Checklist;
use App\Checklist_Files;
use App\Civil_Status;
use App\Gender;
use App\Drugs_Abused;
use App\Educational_Attainment;
use App\Employment_Status;
use Hash;
use Session;
use NumConvert;
use PHPExcel_Style_Border;
use PHPExcel_Style_Alignment;
use Carbon\Carbon;


class ViewController extends Controller
{
   public function getUsers($id)
   {
   	
   	$rolex = User_roles::find($id);
    $urole = Users::where('role',$id)->where('flag',NULL)->with('user_departments')->with('user_roles')->get();
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
   	
   	$depsx = Departments::where('id',$id)->get();
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
      $urole = Users::where('role',$rid)->where('department',$did)->where('flag',NULL)->with('user_departments')->with('user_roles')->get();
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
      $emp = Employees::where('flag',NULL)->get();
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

   public function viewemployee($id)
   {
      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $emp = Employees::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewemployee')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewemployee')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewemployee')->with('roles' , $roles)->with('deps',$deps)->with('emp' ,$emp)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
     }

   public function viewuser($id)
   {
      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $uses = Users::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();

      $notif = DB::table('notifications')->where('notifiable_id',Auth::user()->id)->update(['read_at' => date('Y-m-d')]);

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
   }

   public function viewuserx($id,$pid)
   {
      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $uses = Users::where('flag',NULL)->where('id',$id)->get();
      $graduate = Graduate_Requests::all();

      $notif = DB::table('notifications')->where('notifiable_id',Auth::user()->id)->update(['read_at' => date('Y-m-d')]);

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewuser')->with('roles' , $roles)->with('deps',$deps)->with('uses' ,$uses)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
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

   public function show_my_logs($id)
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $logs = Logs::where('performer_id',$id)->get();
      $graduate = Graduate_Requests::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate);
        }
      else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate);
        }
      else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate);
        }
      else if(Auth::user()->user_role()->first()->name == 'Doctor'){
            return view('doctor.logs')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('logs',$logs)->with('graduate',$graduate);
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
      $jails = City_Jails::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.jails')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails);
        }
        else{
          return abort(404);
        }
   }

    public function show_reports()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $jails = City_Jails::where('flag',NULL)->get();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.reports')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails);
      }
      elseif(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.reports')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails);
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

   public function show_civilstat()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $status = Civil_Status::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.civilstat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('status',$status);
      }
      else
      {
          return abort(404);
      }
   }

   public function show_gender()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $gender = Gender::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.gender')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('gender',$gender);
      }
      else
      {
          return abort(404);
      }
   }

   public function show_dabused()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $dabused = Drugs_Abused::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.dabused')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('dabused',$dabused);
      }
      else
      {
          return abort(404);
      }
      
   }

   public function show_eduatain()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $eduatain = Educational_Attainment::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.eduatain')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('eduatain',$eduatain);
      }
      else
      {
          return abort(404);
      }
      
   }

   public function show_estat()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $reasons = Dismissal_Reason::all();
      $estat = Employment_Status::all();

      if(Auth::user()->user_role()->first()->name == 'Superadmin')
      {
            return view('superadmin.estat')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('reasons',$reasons)->with('graduate',$graduate)->with('estat',$estat);
      }
      else
      {
          return abort(404);
      }
      
   }

    public function show_checklist()
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $checklist = Checklist::where('parent',0)->get();

      if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.checklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate);
        }
        else{
          return abort(404);
        }
   }

   public function show_sub_checklist($id)
   {

      $roles = User_roles::all();
      $deps = Departments::all();
      $users = Users::find(Auth::user()->id);
      $transfer = Transfer_Requests::all();
      $graduate = Graduate_Requests::all();
      $mainlist = Checklist::where('id',$id)->get();
      $checklist = Checklist::where('parent',$id)->get();
      $sublist = Checklist::all();

     
     if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.subchecklist')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('checklist',$checklist)->with('graduate',$graduate)->with('mainlist',$mainlist)->with('sublist',$sublist);
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
                          <th style="width:200px">Path</th>
                          <th style="width:200px">Action</th>
                        </tr>
                      </thead>
                      <tbody id="sampleTable" name="sampleTable">';
    
                  foreach($checklist as $list)
                  {

                      $output .= '<tr><td style="width:200px">'.$list->name.'</td><td style="width:200px"><a href="http://localhost/capstone/public/'.$list->location.'">'.$list->location.'</a></td><td style="width:200px"><button class="btn btn-danger" data-toggle="modal" data-target="#deleteFile" data-fileid="'.$list->id.'" style="margin-left:100px">Delete</button></td></tr>';

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
      $pdf = PDF::loadView('pdf.hello',compact('notes'));
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

   public function samplecsv(request $request)
   {

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


   public function downloadcsv(request $request)
   {

    if($request->input('reports') == 'Accomplishment Report'){
      Excel::load('resources/reports/Monthly Accomplishment Report.xlsx', function($doc) 
      {

      $sheet = $doc->setActiveSheetIndex(0);
      $sheet->setCellValue('H13', 'test');

      $dismiss = Dismissal_Reason::all();
      $limit = count(Dismissal_Reason::all());
      $count = 0;
      $index = 24;

      $reasons = array();

      foreach($dismiss as $dis){
        $reasons[] = $dis->reason;
      }

      for($count=0;$count<$limit;$count++)
      {
        $sheet->setCellValue('B'.$index, $reasons[$count]);
        $index++;
      }

      })->setFileName('Monthly Accomplishment Report')->download('xlsx');

    }

    else if($request->input('reports') == 'Profile Report'){

    $pats = Patients::where('status','Enrolled')->where('department_id',$request->input('departments'))->whereBetween('date_admitted',[$request->input('datefroms'),$request->input('datetos')])->get();
    $dep = Departments::where('id',$request->input('departments'))->get();

    if(count($pats) == 0){
      
        Session::flash('alert-class', 'danger'); 
        flash('No Result', '')->overlay();

        return back();
    }
    else{

    $patient = array();
    $total = count($pats);
    $index = 8;
    $no = 1;

    foreach($dep as $deps)

    foreach($pats as $pat){
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
        $sheet->setCellValue('A4', $depname.' Enrollment  Profile as of '.$datefrom.' - '.$dateto);
        $sheet->getStyle("A$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('A'.$next, 'Prepared by:');
        $sheet->getStyle("D$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('D'.$next, 'Noted by:');
        $sheet->getStyle("K$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('K'.$next, 'Recommending Approval:');
        $sheet->getStyle("P$next")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->setCellValue('P'.$next, 'Approved by:');

        $sheet->getStyle("A$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("A$nexts")->applyFromArray($style2);
        $sheet->setCellValue('A'.$nexts, 'LOVENA G. ALEGRE');

        $sheet->getStyle("D$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("D$nexts")->applyFromArray($style2);
        $sheet->setCellValue('D'.$nexts, 'ANACLETO CLENT L. BANAAY JR., MD, MPM');

        $sheet->getStyle("K$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("K$nexts")->applyFromArray($style2);
        $sheet->setCellValue('K'.$nexts, 'JOSEFEL A. CHUA, RSW, MSW, MPA');

        $sheet->getStyle("P$nexts")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("P$nexts")->applyFromArray($style2);
        $sheet->setCellValue('P'.$nexts, 'JASMIN T. PERALTA, MD, MPH, DPCAM, FPSMSI');

        $sheet->mergeCells("A$nextz:C$nextz");
        $sheet->getStyle("A$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("A$nextz")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("A$nextz")->applyFromArray($style3);
        $sheet->setCellValue('A'.$nextz, 'Social Welfare Officer I ');

        $sheet->getRowDimension("$nextz")->setRowHeight(15);
        $sheet->mergeCells("D$nextz:I$nextz");
        $sheet->getStyle("D$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("D$nextz")->applyFromArray($style3);
        $sheet->setCellValue('D'.$nextz, 'Medical Specialist I');

        $sheet->mergeCells("K$nextz:O$nextz");
        $sheet->getStyle("K$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("K$nextz")->applyFromArray($style3);
        $sheet->setCellValue('K'.$nextz, 'Chief Health Program Officer');

        $sheet->mergeCells("P$nextz:T$nextz");
        $sheet->getStyle("P$nextz")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("P$nextz")->applyFromArray($style3);
        $sheet->setCellValue('P'.$nextz, 'Chief of Hospital II');

        $sheet->mergeCells("D$nextx:I$nextx");
        $sheet->getStyle("D$nextx")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle("D$nextx")->applyFromArray($style3);
        $sheet->setCellValue('D'.$nextx, 'Section Head – OPD and Aftercare Program');

        $sheet->mergeCells("P$nextx:T$nextx");
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
        
        $sheet->getStyle("A$index:T$index")->applyFromArray($style);
        $sheet->mergeCells("B$index:C$index");
        $sheet->mergeCells("D$index:E$index");
        $sheet->mergeCells("H$index:I$index");
        $sheet->mergeCells("K$index:L$index");
        $sheet->mergeCells("M$index:N$index");
        $sheet->getStyle('H'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('J'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('P'.$index)->getAlignment()->setWrapText(true);
        $sheet->getStyle('Q'.$index)->getAlignment()->setWrapText(true);
        $sheet->setCellValue('A'.$index, $no);
        $sheet->setCellValue('B'.$index, $patient[$count]->fname.' '.$patient[$count]->mname.' '.$patient[$count]->lname);
        $sheet->setCellValue('D'.$index, Carbon::parse($patient[$count]->date_admitted)->format('m/d/Y'));
        $sheet->setCellValue('F'.$index, $patient[$count]->civil_status);
        $sheet->setCellValue('G'.$index, Carbon::parse($patient[$count]->birthdate)->age);
        $sheet->setCellValue('H'.$index, $patient[$count]->address->street.' '.$patient[$count]->address->barangay.' '.$patient[$count]->address->city);
        $sheet->setCellValue('J'.$index, $patient[$count]->religion);

        $patos = Patient_Intake_Information::where('patient_id',$patient[$count]->id)->get();
        $patis = Patient_Information::where('patient_id',$patient[$count]->id)->get();
        $history = Patient_History::where('patient_id',$patient[$count]->id)->where(function($q){
          $q->where('type','Enrolled')
            ->orWhere('type','Enrolled from Transfer')
            ->orWhere('type','Re-enrolled');

        })->where('to_dep',$request->input('departments'))->count();
        foreach($patos as $pats)
        foreach($patis as $patss)

        $sheet->setCellValue('P'.$index, $patient[$count]->type->case_name);
      if($patis != '[]'){
        $sheet->setCellValue('K'.$index, $pats->educational_attainment);
        $sheet->setCellValue('Q'.$index, $patss->drugs_abused);
      }
        $sheet->setCellValue('R'.$index, NumConvert::numberOrdinal($history).' Timer');
        $index++;
        $no++;
      }

      })->setFileName($datefrom.' - '.$dateto.' '.$depname.' Profile Report')->download('xlsx');


      }

    }

    else if($request->input('reports') == 'Status Report'){

       Excel::load('resources/reports/Monthly Status Report.xlsx', function($doc) 
      {

      })->setFileName('Monthly Status Report')->download('xlsx');
    }


  }


   public function get_notes($id)
   {
     $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();

     return $notes;
   }
}
