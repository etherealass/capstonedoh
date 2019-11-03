<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Services;
use App\Display;
use App\Notify;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Response;
use Session;
use Redirect;

class ServiceController extends Controller
{
    public function create_service()
	{
		$roles = User_roles::all();
		$rolex = User_roles::find(Auth::user()->id);
		$deps = Departments::all();
		$users = Users::find(Auth::user()->id);
        $transfer = Transfer_Requests::all();
        $graduate = Graduate_Requests::all();

		
		if(Auth::user()->user_role()->first()->name == 'Superadmin'){
			return view('superadmin.createservice')->with(['roles' => $roles, 'rolex' => $rolex, 'deps' => $deps, 'users' => $users])->with('transfer',$transfer)->with('graduate',$graduate);
		}
		elseif(Auth::user()->user_role()->first()->name == 'Admin'){
			return view('superadmin.createservice')->with(['roles' => $roles, 'rolex' => $rolex, 'deps' => $deps, 'users' => $users])->with('transfer',$transfer)->with('graduate',$graduate);
		}
		else{
			return abort(404);
		}
	}

    public function save_services(Request $request){

            return redirect()->back();
    }

	public function show_services()
    {
        $roles = User_roles::all();
        $users = Users::find(Auth::user()->id);
        $deps = Departments::all();
        $transfer = Transfer_Requests::all();
        $service = Services::all();
        $graduate = Graduate_Requests::all();


        if(Auth::user()->user_role()->first()->name == 'Superadmin'){
            return view('superadmin.showservices')->with(['roles' => $roles, 'users' => $users, 'deps' => $deps])->with('transfer',$transfer)->with('services',$service)->with('graduate',$graduate);
        }else if(Auth::user()->user_role()->first()->name == 'Admin'){
            return view('admin.showservices')->with('roles' , $roles)->with('transfer',$transfer)->with('services',$service);
        }else if(Auth::user()->user_role()->first()->name == 'Social Worker'){
            return view('socialworker.showservices')->with('roles' , $roles)->with('transfer',$transfer)->with('services',$service);
        }
    }

    public function add_service(Request $request)
    {	
                        $graduate = Graduate_Requests::all();

        
    	$service = Services::create($request->except('_token'));
    	if ($service->save()) {
    		$display = [];
        		foreach($request->display as $val) {
        			$d = new Display;
        			$d->role = $val;
        			$display[] = $d;
        		}

    		$notify = [];

            if($request->notify){
            		foreach($request->notify as $val) {
            			$d = new Notify;
            			$d->role = $val;
            			$notify[] = $d;
            		}

            		
            $notify = $service->notify()->saveMany($notify);

            }

            $display = $service->display()->saveMany($display);

    	

        	Session::flash('success', 'Service added');
            return back();

        }

    }

    public function viewService(Request $request)
    {   
        
            $service_id = $request->id;
            $services = Services::find($service_id);
            $notify = Notify::where('service_id', $service_id)->with('rolesx')->get();
            $display = Display::where('service_id', $service_id)->with('rolesxe')->get();


               // dd($display);
            $array = ['service'=> $services, 'notify'=> $notify, 'display'=> $display];


                 return response::json($array);



    }

      public function inactiveService(Request $request){

            $set = $request->servicestatus;
            $id = $request->servicesId;

            $inactive = 0;

            if($set == "Delete"){

                  $inactive = 1;
              }else{

                    $inactive =0;
                }

        $services = Services::find($id);

        $services->update(array('inactive' => $inactive));

          if($inactive == 1){
              Session::flash('alert-class', 'danger');
              flash('Service Deleted', '')->overlay();
          }else{

            Session::flash('alert-class', 'success');
              flash('Service  Activated', '')->overlay();
          }

            return redirect('/show_services');
     }

}
