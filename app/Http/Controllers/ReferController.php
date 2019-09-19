<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Events;
use App\Patients;
use App\Refers;
use App\ProgressNotes;

use Hash;
use Session;

class ReferController extends Controller
{
    public function createRefer(Request $request)
    {


         $refer = Refers::create($request->all());
         return Response::json($refer);

    }

    public function addsocialworkernotes(Request $request)
    {


         $socialworker = ProgressNotes::create($request->all());
         return Response::json($socialworker);

    }




    public function getRefer($id) {
   

           // $data = Refers::find($id);

           $data = Refers::where('id', $id)->with('patients')->with('users')->get();

            foreach($data as $adds)
            {

            $user_data = $adds->id;

            }

            //$vals = json_encode($data);


            return Response::json($data);

    }

    function putRefer(Request $request, $id) {

        $ref_date =  $request->ref_date;
        $patient_id = $request->patient_id;
        $ref_at = $request->ref_at;
        $ref_reason = $request->ref_reason;
        $ref_by = $request->ref_by;
        $contact_person = $request->contact_person;
        $recommen = $request->recommen;
        $ref_back = $request->ref_back_date;
        $ref_back_by = $request->ref_back_by;
        $accepted_by = $request->accepted_by;
        $ref_slip     = $request->ref_slip_return;

        $id = Refers::find($id);

        $id->ref_date = $ref_date ? $ref_date : $id->ref_date;
        $id->patient_id = $patient_id ? $patient_id : $id->patient_id;
        $id->ref_at = $ref_at ? $ref_at : $id->ref_at;
        $id->ref_reason = $ref_reason ? $ref_reason : $id->ref_reason;
        $id->ref_by = $ref_by ? $ref_by :  $id->ref_by;
        $id->contact_person = $contact_person ? $contact_person  : $id->contact_person;
        $id->recommen = $recommen ? $recommen : $id->recommen;
        $id->ref_back_date = $ref_back ? $ref_back : $id->ref_back_date;
        $id->ref_back_by = $ref_back_by ? $ref_back_by : $id->ref_back_by;
        $id->accepted_by = $accepted_by ? $accepted_by : $id->accepted_by;
        $id->ref_slip_return = $ref_slip  ? $ref_slip  : $id->ref_slip_return;

        $id->save();
        return Response::json($id);


    }
          

}
        