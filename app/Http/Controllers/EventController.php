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
use App\Patient_Event_List;
use App\Transfer_Requests;
use App\Visit_interven;

use Hash;
use Session;
use PDF;
use Carbon\Carbon;
use Response;



class EventController extends Controller
{
 

    public function delete_patient_event($id){


             $patient = Patient_Event_List::destroy($id);
             return Response::json($patient);

    }

    public function view_add_patient(Request $request){

         $patient_list = Patient_Event_List::create($request->all());

         $id = $patient_list->id;

         $patient = Patient_Event_List::where('id',$id)->with('patients')->get();

         return Response::json($patient);

             
    }

    public function patient_attend_intervention(Request $request){

            $data = $request->all();
        
               // var_dump($data); exit;
             foreach ($data as $record) {
                if (!$record['isChecked'] && $record['rec_id']) {
                    //find record and delete
                    $rec = Visit_interven::find($record['rec_id']);
                    $rec->delete();
                } else {
                    if ($record['isChecked'] && empty($record['rec_id'])) {
                        $rec = new Visit_interven;
                    } else if ($record['isChecked'] && $record['rec_id']) {
                        $rec = Visit_interven::find($record['rec_id']);


                    }

                    $rec->patient_event = 
                    $rec->patient_id = $record['patient_id'];
                    $rec->interven_id = $record['interven_id'];
                    $rec->event_id = $record['event_id'];
                    $rec->remarks = $record['remarks'];
                    $rec->child_interven_id = 10;
                    $rec->created_by = 3;
                    $rec->save();
                }
            }
             
         return Response::json($rec);
        
    }

    public function view_event_attended() {
        $patient_id = isset($_GET['patient_id']) ? $_GET['patient_id'] : 0;
        $event_id = isset($_GET['event_id']) ? $_GET['event_id'] : 0;
        $eventsAttended = Visit_interven::where(['patient_id' => $patient_id, 'event_id' => $event_id])->get();

        return Response::json($eventsAttended);
    }


}