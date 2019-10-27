<style>
  

</style>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Change Password for this current User</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
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

<div class="modal fade" id="transferPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">To what department?</h5>
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
              <div class="modal-body">
                <input type="hidden" name="patientid" id="patientid" value="">
                <input type="hidden" name="patientdep" id="patientdep" value="">
                <p style="font-size: 10px;margin-top: 7px"><h6>{{$dep->department_name}} Department</h6></p>             
              <button class="btn btn-success" data-depid="{{$dep->id}}" data-toggle="modal" data-target="#transferReferral" data-dismiss="modal" style="color:white">
                <span style="" class="float-left">Transfer</span>
                <span  style="" class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </button>
            </div>
            </div>
        </div>
      </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="admintransferReferral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to proceed?</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Specify Transfer Remarks</h5>
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


<div class="modal fade" id="patientGraduate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">  
          <h6 class="modal-title" id="exampleModalLabel"><h5>Graduate</h5><br>Note: Upon submitting, this will be sent to the Administrator for further confirmation</h6>
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
          <h5 class="modal-title" id="exampleModalLabel">Graduate</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Enroll to department?</h5>
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
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to re-enroll this patient?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div style="margin-bottom: 50px">
            <div class="card mb-3 text-black o-hidden h-100">
             
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-success" data-toggle="modal" data-dismiss="modal" data-target="#reenrollForm">Proceed</button>
            <!---<button type="submit" class="btn btn-success">Re-enroll</button> -->
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
          <h5 class="modal-title" id="exampleModalLabel">Add Doctor's Note</h5>
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
