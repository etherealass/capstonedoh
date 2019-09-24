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
use App\Notifications\MySecondNotification;
use App\Notifications\MyThirdNotifications;
use App\Notifications\MyFourthNotifications;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Patients;
use App\Address;
use App\Emergency_Persons;
use App\Patient_Intake_Information;
use App\Patient_Informant;
use App\Patient_Information;
use App\Transfer_Requests;
use App\Graduate_Requests;
use App\Patient_History;
use App\Interventions;
use App\Cities;
use App\Case_Type;
use App\Logs;
use App\Dismissal_Reason;
use App\Dismissal_Records;
use App\Doctors_Progress_Notes;
use App\City_Jails;
use App\Files;
use App\Refers;
use App\Patient_Event_List;
use App\Services;
use App\Display;
use App\ProgressNotes;
use App\DentalNotes;
use Notification;
use Hash;
use Session;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function addpatient()
    {
    	$roles = User_roles::all();
		$deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

    	return view('superadmin.addpatient')->with('roles',$roles)->with('deps',$departmentsps)->with('users',$users)->with('transfer',$transfer);
    }

    public function refer()
    {
    	$roles = User_roles::all();
		$deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

    	return view('superadmin.refpatient')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);
    }

    public function showpatient($stat)
    {
        $pat = Patients::where('status',$stat)->with('departments')->with('address')->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $graduate = Graduate_Requests::all();
        $transfer = Transfer_Requests::all();
        $services = Services::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('service',$services);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('service',$services);
        
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('service',$services);
        }
        else if(Auth::user()->user_role()->first()->name == 'Doctor'){
            return view('doctor.showpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('service',$services);
        }
    }

    public function viewpatient($id)
    {   
        
        $pid = 0;
        $pat = Patients::where('id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->get();
        $patis = Patient_Information::with('informants')->where('patient_id',$id)->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $reasons = Dismissal_Reason::all();
        $graduate = Graduate_Requests::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();
        $refer = Refers::where('patient_id', $id)->get();
        $event_patient = Patient_Event_List::where('patient_id', $id)->with('events')->with('patients')->get();
        $dentalNotes = DentalNotes::where('patient_id', $id)->with('userxk')->get();

       
        $services = Display::with('services')->get();
        $patient_note = ProgressNotes::where('patient_id', $id)->with('servicex')->with('userx')->get();
        $interven = Interventions::where('parent', 0)->get();
        $childInterven = Interventions::where('parent', '!=', 0)->get();



        $notif = DB::table('notifications')->where('notifiable_id',Auth::user()->id)->update(['read_at' => date('Y-m-d')]);

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){

            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('refers', $refer)->with('notes',$notes)->with('patos',$patos)->with('case',$case)->with('jails',$jails)->with('patis',$patis)->with('service',$services)->with('visits', $event_patient)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){

            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('case',$case)->with('jails',$jails)->with('patis',$patis)->with('refers', $refer)->with('service',$services)->with('visits', $event_patient)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);

        }    
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){

            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('case',$case)->with('jails',$jails)->with('patis',$patis)->with('refers', $refer)->with('service',$services)->with('visits', $event_patient)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);

           
        }
        else if(Auth::user()->user_role()->first()->name == 'Doctor'){

            return view('doctor.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('case',$case)->with('jails',$jails)->with('patis',$patis)->with('refers', $refer)->with('service',$services)->with('visits', $event_patient)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
            
        }

    }

    public function viewpatients($id,$pid,$tid)
    {
        $stat = 1;
        $pat = Patients::where('id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->with('eperson')->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfers = Transfer_Requests::where('transfer_id',$tid)->get();
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $reasons = Dismissal_Reason::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $files = Files::all();
        $patient_note = ProgressNotes::where('patient_id', $id)->get();
        $interven = Interventions::where('parent', 0)->get();
        $childInterven = Interventions::where('parent', '!=', 0)->get();
        $dentalNotes = DentalNotes::where('patient_id', $id)->with('userxk')->get();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){


            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('stat',$stat)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
        
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('stat',$stat)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
           
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('stat',$stat)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Doctor'){
          
            return view('doctor.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
    }

     public function viewpatientx($id,$pid,$gid)
    {
        $stat = 0;
        $pat = Patients::where('id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->with('eperson')->get();
        $patis = Patient_Information::with('informants')->where('patient_id',$id)->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $graduates = Graduate_Requests::where('graduate_id',$gid)->get();
        $transfers = Transfer_Requests::where('transfer_id',$gid)->get();
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $reasons = Dismissal_Reason::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $files = Files::all();
        $patient_note = ProgressNotes::where('patient_id', $id)->get();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();
        $interven = Interventions::where('parent', 0)->get();
        $childInterven = Interventions::where('parent', '!=', 0)->get();
        $dentalNotes = DentalNotes::where('patient_id', $id)->with('userxk')->get();



        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
           
            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('stat',$stat)->with('graduates',$graduates)->with('gid',$gid)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('case',$case)->with('jails',$jails)->with('patis',$patis);
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        
        }   
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('case',$case)->with('jails',$jails)->with('patis',$patis);
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfers',$transfers)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Doctor'){
            return view('doctor.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('patos',$patos)->with('notes',$notes)->with('case',$case)->with('jails',$jails)->with('patis',$patis);
            return view('doctor.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('files',$files)->with('DentalNotes', $dentalNotes);
        }
}

    public function viewpatientz($id,$nid)
    {
        $pid = 0;
        $pat = Patients::where('id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->with('eperson')->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $reasons = Dismissal_Reason::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $patient_note = ProgressNotes::where('patient_id', $id)->get();
        $notif = DB::table('notifications')->where('id',$nid)->update(['read_at' => date('Y-m-d')]);
        $interven = Interventions::where('parent', 0)->get();
        $childInterven = Interventions::where('parent', '!=', 0)->get();
        $dentalNotes = DentalNotes::where('patient_id', $id)->with('userxk')->get();

        
        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
        }
        else if(Auth::user()->user_role()->first()->name == 'Doctor'){
            return view('doctor.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('reasons',$reasons)->with('graduate',$graduate)->with('patos',$patos)->with('notes',$notes)->with('patient_notes', $patient_note)->with('intv', $interven)->with('childIntervens', $childInterven)->with('DentalNotes', $dentalNotes);
        }
    }

    public function patientdep()
    {
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $graduate = Graduate_Requests::all();
        $transfer = Transfer_Requests::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.patientdep')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('graduate',$graduate);;
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.patientdep')->with('roles' , $roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('graduate',$graduate);;
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            $id = Auth::user()->department;
            return view('socialworker.chooseform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('graduate',$graduate);;
        }
    }

    public function chooseform($id)
    {
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $graduate = Graduate_Requests::all();
        $transfer = Transfer_Requests::all();

         if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.patientform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.patientform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
    }

    public function intakeform($id)
    {
        $roles = User_roles::where('flag',NULL)->get();
        $deps = Departments::where('flag',NULL)->get();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();


    if(Auth::user()->user_role()->first()->name == 'Superadmin'){
        return view('superadmin.intakeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate)->with('jails',$jails);
        }
    else if(Auth::user()->user_role()->first()->name == 'Admin'){
        return view('admin.intakeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate)->with('jails',$jails);
        }
    else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
        return view('socialworker.intakeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('case',$case)->with('graduate',$graduate)->with('jails',$jails);
        }

    }

    public function ddeform($id)
    {
        $roles = User_roles::where('flag',NULL)->get();
        $deps = Departments::where('flag',NULL)->get();
        $users = Users::find(Auth::user()->id);
        $graduate = Graduate_Requests::all();
        $transfer = Transfer_Requests::all();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();


       if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.ddeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('case',$case);

            }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
             return view('admin.ddeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('case',$case);

            }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
             return view('socialworker.ddeform')->with('roles' , $roles)->with('deps',$deps)->with('id',$id)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate)->with('jails',$jails)->with('case',$case);

            }

    }

    public function save_intake(Request $request)
    {
        $add = rand();
        $emer = rand();
        $pat = rand();
        $mytime = Carbon::now();

        $address = new Address([
            'address_id' => $add,
            'street' => $request->input('street'),
            'barangay' => $request->input('barangay'),
            'city'  => $request->input('city')

        ]);

        $address->save();

        $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }


        $addr = Address::where('address_id',$add)->get();

        foreach($addr as $adds)
        {
            $address_id = $adds->id;
        }

        date_default_timezone_set('Asia/Singapore');

        $patient = new Patients([
            'patient_id' => $pat,
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('bday'),
            'civil_status' => $request->input('civils'),
            'address_id' => $address_id,
            'patient_type' => $request->input('ptype'),
            'jail' => $request->input('jail'),
            'caseno' => $request->input('caseno'),
            'status' => 'Enrolled',
            'date_admitted' => $mytime,
            'department_id' => $request->input('department'),
        ]);

        $patient->save();

        $patient = Patients::with('departments')->where('patient_id', $pat)->get();

        foreach($patient as $patz)
        {
            $id_patient = $patz->id;
            $department_patient = $patz->departments->department_name;

        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Register',
            'action' => 'Registered Patient no. '.$id_patient.' in '.$department_patient.' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        $allusers = Users::all();
        
        Notification::send($allusers, new MySecondNotification($patz));

        $pats = Patients::where('patient_id',$pat)->get();

        foreach($pats as $patss)
        {
            $patient_id = $patss->id;
            $patient_department = $patss->department_id;
        }

        date_default_timezone_set('Asia/Singapore');

        $history = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $patient_id,
            'by' => Auth::user()->id,
            'type' => 'Enrolled',
            'to_dep' => $patient_department,
        ]);

        $history->save();

        $emergency_people = new Emergency_Persons([
            'emergency_id' => $emer,
            'name' => $request->input('emername'),
            'phone' => $request->input('emerphone'),
            'cellphone' => $request->input('emercell'),
            'relationship' => $request->input('emerelation'),
            'email' => $request->input('emeremail'),
        ]);

        $emergency_people->save();

        $emers = Emergency_Persons::where('emergency_id',$emer)->get();

        foreach($emers as $emerss)
        {
            $emergency_id = $emerss->id;
        }


        $patient_intake_info = new Patient_Intake_Information([
            'patient_id' => $patient_id,
            'emergency_id' => $emergency_id,
            'educational_attainment' => $request->input('eduattain'),
            'employment_status' => $request->input('edstat'),
            'spouse' => $request->input('spouse'),
            'father' => $request->input('fathname'),
            'mother' => $request->input('mothname'),
            'presenting_problems' => $request->input('preprob'),    
            'impression' => $request->input('impre'),
            'date' => date('M-j-Y'),
        ]);

            $patient_intake_info->save();  

        Session::flash('alert-class', 'success'); 
        flash('Patient Created', '')->overlay();

        $pat = Patients::with('departments')->with('address')->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $stat = "Enrolled";

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return redirect('/showpatients/'.$stat)->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return redirect('/showpatients/'.$stat)->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return redirect('/showpatients/'.$stat)->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }

    }

    public function reenrollsave_intake(Request $request)
    {
        $patos = Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->get();
        
        if($patos == '[]') {

        
        $emer = rand();

        Address::where('id',$request->input('patientadd'))->update(['street' => $request->input('street')]);
        Address::where('id',$request->input('patientadd'))->update(['barangay' => $request->input('barangay')]);
        Address::where('id',$request->input('patientadd'))->update(['city' => $request->input('city')]);

         $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }

        Patients::where('id',$request->input('patient_id'))->update(['fname' => $request->input('fname')]);
        Patients::where('id',$request->input('patient_id'))->update(['lname' => $request->input('lname')]);
        Patients::where('id',$request->input('patient_id'))->update(['birthdate' => $request->input('bday')]);
        Patients::where('id',$request->input('patient_id'))->update(['civil_status' => $request->input('civils')]);
        Patients::where('id',$request->input('patient_id'))->update(['department_id' => $request->input('department')]);

        if($request->input('sptype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('caseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('jail')]);
        }
        elseif($request->input('ptype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('sptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('scaseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('sjail')]);
        }

        Patients::where('id',$request->input('patient_id'))->update(['status' => 'Enrolled']);
        date_default_timezone_set('Asia/Singapore');
        Patients::where('id',$request->input('patient_id'))->update(['date_admitted' => date('M-j-Y g:i A')]);

        
        $emergency_people = new Emergency_Persons([
            'emergency_id' => $emer,
            'name' => $request->input('emername'),
            'phone' => $request->input('emerphone'),
            'cellphone' => $request->input('emercell'),
            'relationship' => $request->input('emerelation'),
            'email' => $request->input('emeremail'),
        ]);


        $emergency_people->save();


        $emers = Emergency_Persons::where('emergency_id',$emer)->get();

        foreach($emers as $emerss)
        {
            $emergency_id = $emerss->id;
        }

        date_default_timezone_set('Asia/Singapore');

        $patient_intake_info = new Patient_Intake_Information([
            'patient_id' => $request->input('patient_id'),
            'emergency_id' => $emergency_id,
            'educational_attainment' => $request->input('eduattain'),
            'employment_status' => $request->input('edstat'),
            'spouse' => $request->input('spouse'),
            'father' => $request->input('fathname'),
            'mother' => $request->input('mothname'),
            'presenting_problems' => $request->input('preprob'),    
            'impression' => $request->input('impre'),
            'date' => date('M-j-Y g:i A'),
        ]);

            $patient_intake_info->save();  
        
        if($request->input('edvalue') != 1){
        
        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Re-enrolled',
            'action' => 'Re-enrolled Patient no. '.$request->input('patient_id'). ' to '.$name.' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');
        $nhistory->save();

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => 'Re-enrolled',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Re-enrolled', '')->overlay();

        return back();

        }
        elseif($request->input('edvalue') == 1){

        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient ' .$request->input('fvalue'). ' Edited',
            'action' => 'Edited Patient no. '.$request->input('patient_id'). " 's ".$request->input('fvalue'),
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => $request->input('fvalue').' Edited ',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash($request->input('fvalue'). ' Edited', '')->overlay();

        return back();
            }
        }
        else{

        Address::where('id',$request->input('patientadd'))->update(['street' => $request->input('street')]);
        Address::where('id',$request->input('patientadd'))->update(['barangay' => $request->input('barangay')]);
        Address::where('id',$request->input('patientadd'))->update(['city' => $request->input('city')]);

         $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }

        Patients::where('id',$request->input('patient_id'))->update(['fname' => $request->input('fname')]);
        Patients::where('id',$request->input('patient_id'))->update(['lname' => $request->input('lname')]);
        Patients::where('id',$request->input('patient_id'))->update(['birthdate' => $request->input('bday')]);
        Patients::where('id',$request->input('patient_id'))->update(['civil_status' => $request->input('civils')]);
        Patients::where('id',$request->input('patient_id'))->update(['department_id' => $request->input('department')]);
        
        if($request->input('sptype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('caseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('jail')]);
        }
        elseif($request->input('ptype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('sptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('scaseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('sjail')]);
        }

        Patients::where('id',$request->input('patient_id'))->update(['status' => 'Enrolled']);
        date_default_timezone_set('Asia/Singapore');
        Patients::where('id',$request->input('patient_id'))->update(['date_admitted' => date('M-j-Y g:i A')]);

        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['educational_attainment' => $request->input('eduattain')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['employment_status' => $request->input('edstat')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['spouse' => $request->input('spouse')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['father' => $request->input('fathname')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['mother' => $request->input('mothname')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['presenting_problems' => $request->input('preprob')]);
        Patient_Intake_Information::where('patient_id',$request->input('patient_id'))->update(['impression' => $request->input('impre')]);

        Emergency_Persons::where('id',$request->input('emergency_id'))->update(['name' => $request->input('emername')]);
        Emergency_Persons::where('id',$request->input('emergency_id'))->update(['phone' => $request->input('emerphone')]);
        Emergency_Persons::where('id',$request->input('emergency_id'))->update(['cellphone' => $request->input('emercell')]);
         Emergency_Persons::where('id',$request->input('emergency_id'))->update(['relationship' => $request->input('emerelation')]);
        Emergency_Persons::where('id',$request->input('emergency_id'))->update(['email' => $request->input('emeremail')]);

    if($request->input('edvalue') != 1){
        
        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Re-enrolled',
            'action' => 'Re-enrolled Patient no. '.$request->input('patient_id'). ' to '.$name.' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => 'Re-enrolled',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Re-enrolled', '')->overlay();

        return back();

        }
        elseif($request->input('edvalue') == 1){

        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient ' .$request->input('fvalue'). ' Edited',
            'action' => 'Edited Patient no. '.$request->input('patient_id'). " 's ".$request->input('fvalue'),
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => $request->input('fvalue').' Edited ',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash($request->input('fvalue'). ' Edited', '')->overlay();

        return back();
        }

        }

    }

    public function reenrollsave_dde(Request $request)
    {
        $inf = rand();
        $patis = Patient_Information::where('patient_id',$request->input('patient_id'))->get();

        if($patis == '[]'){

            Address::where('id',$request->input('patientadd'))->update(['street' => $request->input('street')]);
            Address::where('id',$request->input('patientadd'))->update(['barangay' => $request->input('barangay')]);
            Address::where('id',$request->input('patientadd'))->update(['city' => $request->input('city')]);

            $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }

            Patients::where('id',$request->input('patient_id'))->update(['fname' => $request->input('fname')]);
            Patients::where('id',$request->input('patient_id'))->update(['lname' => $request->input('lname')]);
            Patients::where('id',$request->input('patient_id'))->update(['mname' => $request->input('mname')]);
            Patients::where('id',$request->input('patient_id'))->update(['birthdate' => $request->input('bday')]);
            Patients::where('id',$request->input('patient_id'))->update(['birthorder' => $request->input('border')]);
            Patients::where('id',$request->input('patient_id'))->update(['religion' => $request->input('religion')]);
            Patients::where('id',$request->input('patient_id'))->update(['gender' => $request->input('gender')]);
            Patients::where('id',$request->input('patient_id'))->update(['nationality' => $request->input('nation')]);
            Patients::where('id',$request->input('patient_id'))->update(['contact' => $request->input('contact')]);
            Patients::where('id',$request->input('patient_id'))->update(['department_id' => $request->input('department')]);

        if($request->input('ddes') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ddeptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('ddecaseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('ddejail')]);
        }
        else if($request->input('ddetype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ddes')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('ddecas')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('ddejs')]);
        }
            Patients::where('id',$request->input('patient_id'))->update(['status' => 'Enrolled']);
            date_default_timezone_set('Asia/Singapore');
            Patients::where('id',$request->input('patient_id'))->update(['date_admitted' => date('M-j-Y g:i A')]);


            $patient_informant = new Patient_Informant([
            'informant_id' => $inf,
            'name' => $request->input('infoname'),
            'address' => $request->input('infoadd'),
            'contact' => $request->input('infocontact'),
             ]);

            $patient_informant->save();

            $infos = Patient_Informant::where('informant_id',$inf)->get();

            foreach($infos as $info)
            {
                $informant_id = $info->id;
            }

            $information = new Patient_Information([
                'patient_id' => $request->input('patient_id'),
                'informant_id' => $informant_id,
                'referred_by' => $request->input('referred'),
                'drugs_abused' => $request->input('dabused'),
                'chief_complaint' => $request->input('ccomplaint'),
                'h_present_illness' => $request->input('pillness'),
                'h_drug_abuse' => $request->input('dused'),
                'famper_history' => $request->input('background'),
            ]);

            $information->save();

        if($request->input('edvalue') != 1){

            $depart = Departments::where('id', $request->input('department'))->get();

            foreach($depart as $deppy)
            {
                $name = $deppy->department_name;
            }

            date_default_timezone_set('Asia/Singapore');

            $logs = new Logs([
                'performer_id' => Auth::user()->id,
                'type' => 'Patient Re-enrolled',
                'action' => 'Re-enrolled Patient no. '.$request->input('patient_id'). ' to '.$name.' Department ',
                'date_time' => date('M-j-Y g:i A'),
                'department_id' => Auth::user()->department,
            ]);

            $logs->save();

            date_default_timezone_set('Asia/Singapore');

            $nhistory = new Patient_History([
                'date' => date('M-j-Y g:i A'),
                'patient_id' => $request->input('patient_id'),
                'by' => Auth::user()->id,
                'type' => 'Re-enrolled',
                'from_dep' => $request->input('patdepartment'),
                'to_dep' => $request->input('department'),
            ]);

            $nhistory->save();

            Session::flash('alert-class', 'success'); 
            flash('Patient Re-enrolled', '')->overlay();

            return back();
        }
        elseif($request->input('edvalue') == 1){

        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient ' .$request->input('fvalue'). ' Edited',
            'action' => 'Edited Patient no. '.$request->input('patient_id'). " 's ".$request->input('fvalue'),
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => $request->input('fvalue').' Edited ',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash($request->input('fvalue'). ' Edited', '')->overlay();

        return back();
        }

        }

        else{
        
        Address::where('id',$request->input('patientadd'))->update(['street' => $request->input('street')]);
        Address::where('id',$request->input('patientadd'))->update(['barangay' => $request->input('barangay')]);
        Address::where('id',$request->input('patientadd'))->update(['city' => $request->input('city')]);

         $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }

        Patients::where('id',$request->input('patient_id'))->update(['fname' => $request->input('fname')]);
        Patients::where('id',$request->input('patient_id'))->update(['lname' => $request->input('lname')]);
        Patients::where('id',$request->input('patient_id'))->update(['mname' => $request->input('mname')]);
        Patients::where('id',$request->input('patient_id'))->update(['birthdate' => $request->input('bday')]);
        Patients::where('id',$request->input('patient_id'))->update(['birthorder' => $request->input('border')]);
        Patients::where('id',$request->input('patient_id'))->update(['religion' => $request->input('religion')]);
        Patients::where('id',$request->input('patient_id'))->update(['gender' => $request->input('gender')]);
        Patients::where('id',$request->input('patient_id'))->update(['nationality' => $request->input('nation')]);
        Patients::where('id',$request->input('patient_id'))->update(['contact' => $request->input('contact')]);
        Patients::where('id',$request->input('patient_id'))->update(['department_id' => $request->input('department')]);
        
       if($request->input('ddes') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ddeptype')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('ddecaseno')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('ddejail')]);
        }
        else if($request->input('ddetype') == NULL){
            Patients::where('id',$request->input('patient_id'))->update(['patient_type' => $request->input('ddes')]);
            Patients::where('id',$request->input('patient_id'))->update(['caseno' => $request->input('ddecas')]);
            Patients::where('id',$request->input('patient_id'))->update(['jail' => $request->input('ddejs')]);
        }

        Patients::where('id',$request->input('patient_id'))->update(['status' => 'Enrolled']);
        date_default_timezone_set('Asia/Singapore');
        Patients::where('id',$request->input('patient_id'))->update(['date_admitted' => date('M-j-Y g:i A')]);

        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['referred_by' => $request->input('referred')]);
        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['drugs_abused' => $request->input('dabused')]);
        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['chief_complaint' => $request->input('ccomplaint')]);
        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['h_present_illness' => $request->input('pillness')]);
        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['h_drug_abuse' => $request->input('dused')]);
        Patient_Information::where('patient_id',$request->input('patient_id'))->update(['famper_history' => $request->input('background')]);

        Patient_Informant::where('id',$request->input('informant_id'))->update(['name' => $request->input('infoname')]);
        Patient_Informant::where('id',$request->input('informant_id'))->update(['address' => $request->input('infoadd')]);
        Patient_Informant::where('id',$request->input('informant_id'))->update(['contact' => $request->input('infocontact')]);

       if($request->input('edvalue') != 1){

            $depart = Departments::where('id', $request->input('department'))->get();

            foreach($depart as $deppy)
            {
                $name = $deppy->department_name;
            }

            date_default_timezone_set('Asia/Singapore');

            $logs = new Logs([
                'performer_id' => Auth::user()->id,
                'type' => 'Patient Re-enrolled',
                'action' => 'Re-enrolled Patient no. '.$request->input('patient_id'). ' to '.$name.' Department ',
                'date_time' => date('M-j-Y g:i A'),
                'department_id' => Auth::user()->department,
            ]);

            $logs->save();

            date_default_timezone_set('Asia/Singapore');

            $nhistory = new Patient_History([
                'date' => date('M-j-Y g:i A'),
                'patient_id' => $request->input('patient_id'),
                'by' => Auth::user()->id,
                'type' => 'Re-enrolled',
                'from_dep' => $request->input('patdepartment'),
                'to_dep' => $request->input('department'),
            ]);

            $nhistory->save();

            Session::flash('alert-class', 'success'); 
            flash('Patient Re-enrolled', '')->overlay();

            return back();
        }
        elseif($request->input('edvalue') == 1){

        $depart = Departments::where('id', $request->input('department'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient ' .$request->input('fvalue'). ' Edited',
            'action' => 'Edited Patient no. '.$request->input('patient_id'). " 's ".$request->input('fvalue'),
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patient_id'),
            'by' => Auth::user()->id,
            'type' => $request->input('fvalue').' Edited ',
            'from_dep' => $request->input('patdepartment'),
            'to_dep' => $request->input('department'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash($request->input('fvalue'). ' Edited', '')->overlay();

        return back();
        }

        }

    }

    public function save_dde(Request $request)
    {
        $add = rand();
        $inf = rand();
        $pat = rand();

        $address = new Address([
            'address_id' => $add,
            'street' => $request->input('street'),
            'barangay' => $request->input('barangay'),
            'city'  => $request->input('city')

        ]);

        $address->save();

        $cities = Cities::where('name',$request->input('city'))->get();

        
           if(count($cities) == 0){
                $city = new Cities([
                'name' => $request->input('city'),
                ]);

                 $city->save();
           }

        $addr = Address::where('address_id',$add)->get();

        foreach($addr as $adds)
        {
            $address_id = $adds->id;
        }

        date_default_timezone_set('Asia/Singapore');

        $patient = new Patients([
            'patient_id' => $pat,
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'mname' => $request->input('mname'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('bday'),
            'birthorder' => $request->input('border'),
            'address_id' => $address_id,
            'contact' => $request->input('contact'),
            'gender' => $request->input('gender'),
            'civil_status' => $request->input('civils'),
            'nationality' => $request->input('nation'),
            'religion' => $request->input('religion'),
            'patient_type' => $request->input('ptype'),
            'jail' => $request->input('jail'),
            'caseno' => $request->input('caseno'),
            'status' => 'Enrolled',
            'date_admitted' => date('M-j-Y g:i A'),
            'department_id' => $request->input('department'),
        ]);

        $patient->save();

        $patient = Patients::with('departments')->where('patient_id', $pat)->get();

        foreach($patient as $patz)
        {
            $id_patient = $patz->id;
            $department_patient = $patz->departments->department_name;

        }

        date_default_timezone_set('Asia/Singapore');
        
        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Register',
            'action' => 'Registered Patient no. '.$id_patient.' in '.$department_patient.' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        $allusers = Users::all();
        
        Notification::send($allusers, new MySecondNotification($patz));

        $pats = Patients::where('patient_id',$pat)->get();

        foreach($pats as $patss)
        {
            $patient_id = $patss->id;
            $patient_department = $patss->department_id;
        }

        date_default_timezone_set('Asia/Singapore');

        $history = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $patient_id,
            'by' => Auth::user()->id,
            'type' => 'Enrolled',
            'to_dep' => $patient_department,
        ]);

        $history->save();

        $patient_informant = new Patient_Informant([
            'informant_id' => $inf,
            'name' => $request->input('infoname'),
            'address' => $request->input('infoadd'),
            'contact' => $request->input('infocontact'),
        ]);

        $patient_informant->save();

        $infos = Patient_Informant::where('informant_id',$inf)->get();

        foreach($infos as $info)
        {
            $informant_id = $info->id;
        }

        $information = new Patient_Information([
            'patient_id' => $patient_id,
            'informant_id' => $informant_id,
            'referred_by' => $request->input('referred'),
            'drugs_abused' => $request->input('dabused'),
            'chief_complaint' => $request->input('ccomplaint'),
            'h_present_illness' => $request->input('pillness'),
            'h_drug_abuse' => $request->input('dused'),
            'famper_history' => $request->input('background'),
        ]);

        $information->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Created', '')->overlay();

        $pat = Patients::with('departments')->with('address')->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
        }

    }

    public function flagdelete(Request $request)
    {
        $id = $request->input('patientid');

        Patients::where('id',$id)->update(['flag' => 'deleted']);
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

        Session::flash('alert-class', 'danger'); 
        flash('Patient Deleted', '')->overlay();

        $pat = Patients::with('departments')->with('address')->get();
        $roles = User_roles::all();
        $deps = Departments::all();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showpatient')->with('roles',$roles)->with('deps',$deps)->with('pat',$pat)->with('users',$users)->with('transfer',$transfer);
        }
    }

    public function transferPatient(Request $request)
    {
        $trans = rand();
        
        $transfer = new Transfer_Requests([
            'transfer_id' => $trans,
            'from_department' => $request->input('patientdep'),
            'to_department' => $request->input('depid'),
            'patient_id' => $request->input('patientid'),
            'remarks' => $request->input('referral'),
        ]);

        $transfer->save();


        $tranz = Transfer_Requests::with('transfer_departments')->where('transfer_id',$trans)->get();

        foreach($tranz as $transf)
        {
            $transf->transfer_id;
            $to_department = $transf->transfer_department->department_name;
            $from_department = $transf->transfer_departments->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Transfer Request',
            'action' => 'Requested a Transfer for Patient no. '.$request->input('patientid').' from '.$from_department.' Department '.$to_department,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $history = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'For Transfer',
            'from_dep' => $request->input('patientdep'),
            'to_dep' => $request->input('depid'),
            'remarks' => $request->input('referral'),
        ]);

        $history->save();

        $allusers = Users::all();

        Notification::send($allusers, new MyThirdNotifications($transf));

        Session::flash('alert-class', 'success'); 
        flash('Transfer Request Sent', '')->overlay();

        return back();
    }

    public function adminpatientTransfer(Request $request)
    {
        date_default_timezone_set('Asia/Singapore');

        Patients::where('id',$request->input('patientid'))->update(['department_id' => $request->input('depid')]);
        Patients::where('id',$request->input('patientid'))->update(['date_admitted' => date('M-j-Y g:i A')]);

        $patientdep = Patients::with('departments')->where('id', $request->input('depid'))->get();

        foreach($patientdep as $patd)
        {
            $id_patient = $patd->id;
            $department_patient = $patd->departments->department_name;

        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Transfered',
            'action' => 'Transfered Patient no. '.$request->input('patientid').' to '.$department_patient.' Department',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'Enrolled from Transfer',
            'to_dep' => $request->input('depid'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Transferred', '')->overlay();

        return back();

    }
    public function patientTransfer($id,$did,$tid,$pid)
    {

        date_default_timezone_set('Asia/Singapore');

        Patients::where('id',$id)->update(['department_id' => $did]);
        Patients::where('id',$id)->update(['date_admitted' => date('M-j-Y g:i A')]);
        Transfer_Requests::where('transfer_id',$tid)->update(['status' => 'transfered']);
        $notif = DB::table('notifications')->where('id',$pid)->update(['read_at' => date('Y-m-d')]);
        
        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Transfer Approved',
            'action' => 'Approved a Transfer Request for Patient no. '.$id,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $id,
            'by' => Auth::user()->id,
            'type' => 'Enrolled',
            'to_dep' => $did,
        ]);

        $nhistory->save();

        $pid = 0;
        $pat = Patients::where('id',$id)->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $graduate = Graduate_Requests::all(); 
        $transfer = Transfer_Requests::where('transfer_id',$tid)->get();
        $history = Patient_History::where('patient_id',$id)->get();
        $reasons = Dismissal_Reason::all();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->with('eperson')->get();

        Session::flash('alert-class', 'success'); 
        flash('Patient Enrolled', '')->overlay();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos);
        }
    }

    public function dismiss_patient(Request $request)
    {

        $dismiss_id = rand();

        Patients::where('id',$request->input('patientid'))->update(['status' => 'Dismissed']);

        if($request->input('dismissal') != "Others"){
        
         $reas = Dismissal_Reason::where('id',$request->input('dismissal'))->get();
            
         foreach($reas as $reass)
         {
                $rem = $reass->reason;
         }

        $dismiss = new Dismissal_Records([
            'd_record_id' => $dismiss_id,
            'dismissal_id' => $request->input('dismissal'),
            'in_department' => $request->input('patientdep'),
            'patient_id' => $request->input('patientid'),
            'remarks' => $rem,
        ]);

            $dismiss->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'Dismissed',
            'from_dep' => $request->input('patientdep'),
            'to_dep' => $request->input('patientdep'),
            'remarks'=> $rem,
        ]);

        $nhistory->save();
        }
        else if($request->input('dismissal') == "Others"){
         

        $dismiss = new Dismissal_Records([
            'd_record_id' => $dismiss_id,
            'in_department' => $request->input('patientdep'),
            'patient_id' => $request->input('patientid'),
            'remarks' =>  $request->input('remarks'),
        ]);

        $dismiss->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'Dismissed',
            'to_dep' => $request->input('patientdep'),
            'remarks'=> $request->input('remarks'),
        ]);

        $nhistory->save();

        }
        
        date_default_timezone_set('Asia/Singapore');

        $patientdep = Patients::with('departments')->where('id', $request->input('patientid'))->get();

        foreach($patientdep as $patd)
        {
            $id_patient = $patd->id;
            $department_patient = $patd->departments->department_name;

        }

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Dismissed',
            'action' => 'Dismissed Patient no. '.$request->input('patientid').' from '. $department_patient. ' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();


        Session::flash('alert-class', 'danger'); 
        flash('Patient Dismissed', '')->overlay();

        return back();

    }

    public function graduate_patient(Request $request)
    {

        Patients::where('id',$request->input('patientid'))->update(['status' => 'For Graduate']);

        $grad = rand();

        $graduate = new Graduate_Requests([
            'graduate_id' => $grad,
            'in_department' => $request->input('patientdep'),
            'patient_id' => $request->input('patientid'),
            'remarks' => $request->input('remarks'), 
        ]);

        $graduate->save();

        $gradz = Graduate_Requests::with('graduate_departments')->where('graduate_id',$grad)->get();

        foreach($gradz as $gradu)
        {
            $gradu->graduate_id;
            $in_department = $gradu->graduate_departments->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Graduate Request',
            'action' => 'Requested to Graduate Patient no. '.$request->input('patientid').' in '.$in_department,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $history = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'For Graduate',
            'to_dep' => $request->input('patientdep'),
            'remarks' => $request->input('remarks'),
        ]);

        $history->save();

        $allusers = Users::all();

        Notification::send($allusers, new MyFourthNotifications($gradu));

        Session::flash('alert-class', 'success'); 
        flash('Graduate Request Sent', '')->overlay();

        return back();
    }

    public function graduateadmin_patient(Request $request)
    {
        Patients::where('id',$request->input('patientid'))->update(['status' => 'Graduated']);
        $depart = Departments::where('id', $request->input('patientdep'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Graduated',
            'action' => 'Graduated Patient no. '.$request->input('patientid').' in '.$name.' Department ' ,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $history = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'Graduated',
            'to_dep' => $request->input('patientdep'),
        ]);

        $history->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Graduated', '')->overlay();

        return back();
    }

    public function patientGraduate($id,$did,$gid,$pid)
    {

        date_default_timezone_set('Asia/Singapore');

        Patients::where('id',$id)->update(['status' => 'Graduated']);
        Graduate_Requests::where('graduate_id',$gid)->update(['status' => 'approved']);
        $notif = DB::table('notifications')->where('id',$pid)->update(['read_at' => date('Y-m-d')]);
        
        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Graduation Approved',
            'action' => 'Approved a Graduation Request for Patient no. '.$id,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $id,
            'by' => Auth::user()->id,
            'type' => 'Graduated',
            'from_dep' => $did,
            'to_dep' => $did,
        ]);

        $nhistory->save();

        $pid = 0;   
        $pat = Patients::where('id',$id)->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id); 
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->get();
        $patis = Patient_Information::with('informants')->where('patient_id',$id)->get();
        $reasons = Dismissal_Reason::all();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();

        Session::flash('alert-class', 'success'); 
        flash('Patient Graduated', '')->overlay();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('reasons',$reasons)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('reasons',$reasons)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('notes',$notes)->with('patos',$patos)->with('reasons',$reasons)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
    }

    public function declineGraduate($id,$did,$gid,$pid)
    {

        date_default_timezone_set('Asia/Singapore');

        Patients::where('id',$id)->update(['status' => 'Enrolled']);
        Graduate_Requests::where('graduate_id',$gid)->update(['status' => 'declined']);
        $notif = DB::table('notifications')->where('id',$pid)->delete();
        
        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Graduation Declined',
            'action' => 'Declined a Graduation Request for Patient no. '.$id,
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $id,
            'by' => Auth::user()->id,
            'type' => 'Graduate Request Declined',
            'from_dep' => $did,
            'to_dep' => $did,
        ]);

        $nhistory->save();

        $pid = 0;
        $pat = Patients::where('id',$id)->get();
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id); 
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();
        $history = Patient_History::where('patient_id',$id)->get();
        $notes = Doctors_Progress_Notes::where('patient_id',$id)->get();
        $patos = Patient_Intake_Information::where('patient_id',$id)->get();
        $patis = Patient_Information::with('informants')->where('patient_id',$id)->get();
        $reasons = Dismissal_Reason::all();
        $case = Case_Type::where('flag',NULL)->get();
        $jails = City_Jails::where('flag',NULL)->get();

        Session::flash('alert-class', 'danger'); 
        flash('Declined Request', '')->overlay();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
        else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
        else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.viewpatient')->with('roles' , $roles)->with('deps',$deps)->with('pat' ,$pat)->with('users',$users)->with('pid',$pid)->with('transfer',$transfer)->with('history',$history)->with('graduate',$graduate)->with('reasons',$reasons)->with('notes',$notes)->with('patos',$patos)->with('patis',$patis)->with('case',$case)->with('jails',$jails);
        }
    }

    public function reenroll_patient(Request $request)
    {
        Patients::where('id',$request->input('patientid'))->update(['department_id' => $request->input('patientdep')]);
        Patients::where('id',$request->input('patientid'))->update(['status' => 'Enrolled']);
        date_default_timezone_set('Asia/Singapore');
        Patients::where('id',$request->input('patientid'))->update(['date_admitted' => date('M-j-Y g:i A')]);

        $depart = Departments::where('id', $request->input('patientdep'))->get();

        foreach($depart as $deppy)
        {
            $name = $deppy->department_name;
        }

        date_default_timezone_set('Asia/Singapore');

        $logs = new Logs([
            'performer_id' => Auth::user()->id,
            'type' => 'Patient Re-enrolled',
            'action' => 'Re-enrolled Patient no. '.$request->input('patientid'). ' to '.$name.' Department ',
            'date_time' => date('M-j-Y g:i A'),
            'department_id' => Auth::user()->department,
        ]);

        $logs->save();

        date_default_timezone_set('Asia/Singapore');

        $nhistory = new Patient_History([
            'date' => date('M-j-Y g:i A'),
            'patient_id' => $request->input('patientid'),
            'by' => Auth::user()->id,
            'type' => 'Re-enrolled',
            'to_dep' => $request->input('patientdep'),
        ]);

        $nhistory->save();

        Session::flash('alert-class', 'success'); 
        flash('Patient Re-enrolled', '')->overlay();

        return back();

    }

    public function doctor_notes(Request $request)
    {
        $note_id = rand();

        date_default_timezone_set('Asia/Singapore');

        $note = new Doctors_Progress_Notes([
            'progress_id' => $note_id,
            'doctor_id' => $request->input('doctorid'),
            'patient_id' => $request->input('patientid'),
            'date_time' => date('M-j-Y g:i A'),
            'notes' => $request->input('note'),

        ]);

        $note->save();

        Session::flash('alert-class', 'success'); 
        flash('Note Added', '')->overlay();

        return back();
    }


}
