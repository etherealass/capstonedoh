<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyNotifications;
use Auth;
use DB;
use App\Files;
use App\User_roles;
use App\Users;
use App\Departments;
use App\Transfer_Requests;
use App\Graduate_Requests;
use Session;

class UploadController extends Controller
{
    public function index(){

    	$files = Files::all();

    	$roles = User_roles::all();
		$deps = Departments::all();
      	$users = Users::find(Auth::user()->id);
      	$transfer = Transfer_Requests::all();
      	$graduate = Graduate_Requests::all();

    	return view('superadmin.upload')->with('files', $files)->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer)->with('graduate',$graduate);
    }

    public function store(Request $request){
    	
    	$messages = [
    		'required' => 'Please select file to upload',
		];

    	$this->validate($request, [
    		'file' => 'required',
    	], $messages);

    	foreach ($request->file as $file) {
    		$filename = time().'_'.$file->getClientOriginalName();
	    	$filesize = $file->getClientSize();
	    	$file->move(public_path('files'),$filename);
	    	$fileModel = new Files;
	    	$fileModel->name = $filename;
	    	$fileModel->size = $filesize;
	    	$fileModel->location = 'files/'.$filename;
	    	$fileModel->save();    		
    	}
    	

        Session::flash('alert-class', 'success'); 
        flash('File Uploaded', '')->overlay();

        return back();
   
    		
    }

}
