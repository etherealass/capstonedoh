<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Ready to Leave?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{URL::to('/logout')}}">Logout</a>
        </div>
      </div>
    </div>
</div>

<div class="modal3 fade" id="viewProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 1000px">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>USER PROFILE</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h1 style="font-size: 50px;text-align: center"><b>{{Auth::user()->user_role->name}}</b></h1>
          <div class="dropdown-divider"></div>
          <div class="row">
            <div class="col-md-3">
              <i class="fas fa-user-circle fa-fw" style="font-size: 200px"></i>
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-md-9" style="margin-top: 10px">
                  <h5><b>Name: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->fname}} {{Auth::user()->lname}}</h5>
                </div>
                <div class="col-md-9">
                  <h5><b>Username: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->username}}</h5>
                </div>
                <div class="col-md-9">
                  <h5><b>Email: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->email}}</h5>
                </div>
                <div class="col-md-9">
                  <h5><b>Contact: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->contact}}</h5>
                </div>
      
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Change Password</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/changepass')}}" method="post" id="changep">
          {{csrf_field()}} 
          <div class="modal-body">
           <div class="alert alert-danger" id="wrong" style="display: none">Current Password does not match</div>
           <div class="alert alert-danger" id="correct" style="display: none">New Password same as Old Password</div>
           <label for="oldpass"><h6>Current Password*</h6></label>
           <input type="password" id="oldpass" name="oldpass" placeholder="Enter current password" class="form-control" value="">
           <div style="margin-bottom: 10px"></div>
           <label for="newpass"><h6>New Password*</h6></label>
           <input type="password" id="newpass" name="newpass" placeholder="Enter new password" class="form-control" value="">
           <input type="hidden" id="userid" name="userid" class="form-control" value="{{Auth::user()->id}}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Change Password</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="passwordsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
          <div class="modal-body">
            <h2 class="text-success">Password Changed Successfuly</h2>
          </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to delete this?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/deleteuser')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="user_id" name="user_id" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
      </div>
    </div>
</div>
    
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Change Password for this current User</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/changepassword')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <label for="newpass"><h6>New Password*</h6></label>
          <input type="password" id="newpass" name="newpass" class="form-control" value="">
           <input type="hidden" id="userid" name="userid" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Change Password</button>  
          </div>
        </form>
      </div>
    </div>
</div>


<!--modal for Refer Button-->

<div class="modal fade" id="deleteemployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to delete this?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/delete_employee')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="employee_id" name="employee_id" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="deleteRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to delete this?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/deletenow')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="role" name="role" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="deletePatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to delete this?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/deletepatient')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="admintransferReferral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to proceed?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/admin_transfer_patient')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="depid" name="depid" class="form-control" value="">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
           <input type="hidden" id="patientdep" name="patientdep" class=" form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#transferPatient" data-toggle="modal">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="transferReferral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content"> 
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Specify Transfer Remarks</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/patientTransfer')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="depid" name="depid" class="form-control" value="">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
           <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
          <textarea type="text" id="referral" name="referral" class="form-control" value="" style="height: 100px"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#transferPatient" data-toggle="modal">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="deptransferReferral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to proceed?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/admin_transfer_patient')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="depid" name="depid" class="form-control" value="">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
           <input type="hidden" id="patientdep" name="patientdep" class=" form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#transferPatient" data-toggle="modal">Back</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>


<div class="modal fade" id="patientGraduate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">  
          <h5 class="modal-title" id="exampleModalLabel"><b>Graduate</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/graduate_patient')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
          <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
          <textarea type="text" id="remarks" name="remarks" class="form-control" placeholder="Specify graduate remarks" value=""></textarea>
          </div>
          <div class="modal-footer">
            <span><h6><b>Important Note:</b> Upon submitting, this will be sent to the Administrator for further confirmation</h6></span>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="patientadminGraduate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">  
          <h5 class="modal-title" id="exampleModalLabel"><b>Graduate</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/graduateadmin_patient')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
          <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
          <h6> You are about to graduate this patient. Proceed?</h6>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Proceed</button>  
          </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="patientadminReenroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Enroll to department?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
           @foreach($deps as $dep)
           @if($dep->id != Auth::user()->department)
        <div class="row" style="margin-left: 55px;margin-bottom: 5px; margin-top: 0px">
          <div class="col-xl-10 col-sm-9 mb-10" style="height: 9rem;margin-top: 10px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
             <form action="{{URL::to('/reenroll_patient')}}" method="post">
                {{csrf_field()}}
              <div class="modal-body">
                <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
                <input type="hidden" name="patientdep" id="patientdep" value="{{$dep->id}}">
                <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>             
               <button type="submit" class="btn btn-success">Re-enroll</button>
            </div>
          </form>
            </div>
        </div>
      </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="patientReenroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure you want to re-enroll this patient?</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
            <div class="card mb-3 text-black o-hidden h-100">    
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#reenrollForm">Proceed</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade modal-xl" id="addNotes" tabindex="2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="width:800px">
        <div class="modal-header" style="width:800px">
          <h5 class="modal-title" id="exampleModalLabel"><b>Add Doctor's Note</b></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
            <div class="card mb-3 text-black o-hidden h-100">
             <form action="{{URL::to('/add_notes')}}" method="post">
                {{csrf_field()}}
              <div class="modal-body" style="width:800px">
                <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
                <input type="hidden" name="doctorid" id="doctorid" value="">
                <textarea style="margin-left:0px;height: 100px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note"></textarea>          
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add</button>  
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
