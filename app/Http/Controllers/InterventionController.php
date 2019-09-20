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
use App\Interventions;
use App\Departments;
use App\Transfer_Requests;
use Session;


class InterventionController extends Controller
{
   
    public function showintervention()
     {

        
        $roles = User_roles::all();
        $deps = Departments::all();
        $inter = Interventions::where('parent', 0)->get();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('intervention.showintervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer);
        }
        else{
            return abort(404);
        }

    }

     public function addintervention()
     {

    
        $roles = User_roles::all();
        $deps = Departments::all();
        $users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();

     //   $inter = Interventions::all();

        $inter = Interventions::where('parent', 0)->get();

        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer);
        }
        else{
            return abort(404);
        }

    }

      public function create_intervention(Request $request)
     { 

        $roles = User_roles::all();
        $deps = Departments::all();
        $inter = Interventions::where('parent', 0)->get();
        $users = Users::find(Auth::user()->id);

        $transfer = Transfer_Requests::all();

          $input = $request->all(); 


              $interven = new Interventions([
                'parent' => $request->input('parent'),
                'interven_name' => $request->input('name'),
                'descrp' => $request->input('descrpt'),
                ]);

      $interven->save();
      Session::flash('alert-class', 'success'); 
      flash('Intervention Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();

          if(Auth::user()->user_role()->first()->name == 'Superadmin'){
           return view('intervention.addIntervention')->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer);
        }
        else{
            return abort(404);
        }
         
         
     }

      public function viewIntervention($id)
     { 


        $roles = User_roles::all();
        $deps = Departments::all();
        $intersx = Interventions::find($id);

        $inter = Interventions::where('parent', $id)->get();
        $users = Users::find(Auth::user()->id);

        $transfer = Transfer_Requests::all();

          if(Auth::user()->user_role()->first()->name == 'Superadmin'){
           return view('intervention.viewIntervention')->with('interven', $intersx)->with('roles',$roles)->with('deps',$deps)->with('inter', $inter)->with('users',$users)->with('transfer',$transfer);
        }
         
         
     }

     public function patientInterven(Request $request)
     {

          $input = $request->all(); 

          var_dump($input);

          exit;

     }
   
}