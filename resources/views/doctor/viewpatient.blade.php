@extends('main')
@section('content')


    <style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

    </style>

        <!-- Breadcrumbs-->
      @if($pid)
        @foreach($pat as $pats)
          @if($pats->department_id != Auth::user()->department)
            @foreach($transfers as $trans)
              @if($trans->status == "")
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:550px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
        </ol>
              @elseif(Auth::user()->department == $pats->department_id)
          <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
        </ol>
              @endif
            @endforeach

          @include('flash::message')
        <!-- Icon Cards-->
        <div class="container">
         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Name:</h5> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date of Birth:</h5> {{$pats->birthdate}}</p>
              </div>
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Address:</h5> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Marital Status:</h5> {{$pats->civil_status}}</p>
              </div>
              <div class="col-md-1">
                <p style="font-size: 15px"><h5>Age:</h5> {{$pats->age}}</p>
              </div>
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Date Admitted:</h5> {{$pats->date_admitted}}</p>
              </div>
           </div>
           <div class="row">
          @if($pats->birthorder != NULL)
            @if($pats->birthorder != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Birth Order:</h5> {{$pats->birthorder}}</p>
              </div>
            @endif
            @if($pats->contact != 'NULL')
              <div class="col-md-3">
                <p style="font-size: 15px"><h5>Contact Number:</h5> {{$pats->contact}}</p>
              </div>
            @endif
            @if($pats->nationality != 'NULL')
              <div class="col-md-2">
                <p style="font-size: 15px"><h5>Nationality:</h5> {{$pats->nationality}}</p>
              </div>
            @endif
            @if($pats->religion != 'NULL')
              <div class="col-md-2"> 
                <p style="font-size: 15px"><h5>Religion:</h5> {{$pats->religion}}</p>
              </div>
            @endif
          @endif
           </div>
          </div>
          </fieldset>
          <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Transfer Remarks</legend>
          <div class="container" style="margin-left: 10px">
            <div class="row">
            @foreach($transfers as $trans)
              <p style="margin-left: 30px">{{$trans->remarks}}</p>
            @endforeach
           </div>
           <div class="row">
          
           </div>
          </div>
          </fieldset>
        </div>
          @endif
        @endforeach

      @elseif($pid == '0')
        @foreach($pat as $pats) 
          @if($pats->department_id == Auth::user()->department)
        @if($pats->status == 'Enrolled')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-primary">Enrolled</span></p>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-4" style="margin-top: 10px">
    
                <button class="btn btn-success" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientGraduate" style="margin-left:10px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" data-toggle="modal" data-patientdep="{{$pats->department_id}}" data-patientid="{{$pats->id}}" data-target="#patientDismiss" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
    
          </div>
         </div>
            @elseif($pats->status == 'For Graduate')
            <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-warning">For Graduation</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
            <ol class="breadcrumb" style="height: 100px;font-size:40px;text-align: center;">
              <li class="breadcrumb-item active" style="margin-left: 60px;margin-top: 20px"><span><h3>---Pending---<h3></span></li>
            </ol>
          </div>
         </div>
         @elseif($pats->status == 'Graduated')
            <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-success">Graduated</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
            <ol class="breadcrumb" style="height: 100px;font-size:40px;text-align: center;">
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientadminGraduate" style="margin-left:105px;height: 60px;width: 90px;margin-top: 10px">Enroll</button>
            </ol>
          </div>
         </div>
          @elseif($pats->status == 'Dismissed')
            <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-danger">Dismissed</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
        
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-patientdep="{{Auth::user()->department}}" data-toggle="modal" data-target="#patientReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
        
          </div>
         </div>
         @endif


          @include('flash::message')
        <!-- Icon Cards-->
          <div class="row" style="margin-left: 0px;">
          <div style="">
            <div class="col-md-12 scrollAble2" style="margin-right: 0px;">
             <ul class="sidebar navbar-nav" style="background-color:white;border-radius: 5rem;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border-radius: 5rem">
                <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px;border-radius: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>Information</h6></a>
                </li>
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>Refer</h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>Sessions</h6></a>
                </li>
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>History</h6></a>
                </li>
                <li class="nav-item"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>Intake</h6></a>
                </li>
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6>Doctor's Progress Notes</h6></a>
                </li>
            </ul>
            </div>
          </div>
            <div class="col-md-9" style="margin-top: 10px">
              <div class="tab-content" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-2">
                          <p style="font-size: 8px"><h6>Name:</h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                         </div>
                       <div class="col-md-2">
                          <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                       </div>
                      <div class="col-md-4">
                        <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-2">
                       <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                      </div>
                      <div class="col-md-1">
                         <p style="font-size: 8px"><h6>Age:</h6> {{$pats->age}}</p>
                      </div>
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-2">
                        <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-2">
                      <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-2"> 
                     <p style="font-size: 8px"><h6>Religion:</h6> {{$pats->religion}}</p>
                  </div>
                 @endif
                @endif
                  </div>
                </fieldset>
                 <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                    <div class="container" style="margin-left: 10px">
                      <div class="row">
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Department:</h6> {{$pats->departments->department_name}} Department</p>
                       </div>
                       <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Date Admitted:</h6> {{$pats->date_admitted}}</p>
                       </div>
                       @if($pats->case != "")
                        <div class="col-md-2">
                        <p style="font-size: 8px"><h6>Case Type:</h6> {{$pats->case}}</p>
                       </div>
                       @endif
                       @if($pats->submission != "")
                        <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Submission Type:</h6> {{$pats->submission}}</p>
                       </div>
                       @endif
                        <div class="col-md-10">
          
                       </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Patient History</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date</th>
                               <th>Performed By</th>
                               <th>Type</th>
                               <th>From Department</th>
                               <th>To Department</th>
                               <th>Remarks</th>
                            </tr>
                            </thead>
                          <tbody>
                            @foreach($history as $hist)
                            <tr>
                              <td>{{$hist->date}}</td>
                              <td>{{$hist->userss->fname}} {{$hist->userss->lname}}</td>
                              <td>{{$hist->type}}</td>
                              @if($hist->dep)
                              <td>{{$hist->dep->department_name}} Department</td>
                              @else
                              <td></td>
                              @endif  
                              <td>{{$hist->deps->department_name}} Department</td>
                              <td>{{$hist->remarks}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
                <div class="tab-pane fade" id="v-pills-doctornote" role="tabpanel" aria-labelledby="v-pills-doctornote-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes </legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                           <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-file-pdf"></i>Print</button></a></div>
                          @if(Auth::user()->user_role->name == 'Doctor')
                          <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a><button class="btn btn-success" data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
                          @endif
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date/Time</th>
                               <th>Notes</th>
                            </tr>
                            </thead>
                          <tbody>
                          @foreach($notes as $note)
                            <tr>
                              <td>{{$note->date_time}}</td>
                              <td>{{$note->notes}}</td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
              </div>
            </div>
          </div>
          @elseif($pats->department_id != Auth::user()->department)
           <h1>Patient Not Found/Transfered/Deleted</h1>
        @endif
        @endforeach
      @endif

  <div class="modal fade" id="patientDismiss" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Specify a reason to dismiss</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/patientDismiss')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body" style="margin-bottom: 50px">
          <div class="form-label-group" style="height: 100px">
              <input type="hidden" id="patientid" name="patientid" class="form-control" value="">
              <input type="hidden" id="patientdep" name="patientdep" class="form-control" value="">
                <select class="form-control" id="dismissal" placeholder="Dismissal Reason" required="required" name="dismissal">
                  <label for="dismissal">Dismissal Reason</label>
                    <option value="" disabled selected hidden>--Choose a Reason--</option>
                     @foreach($reasons as $reas)
                    <option value="{{$reas->id}}">{{$reas->reason}}</option>
                     @endforeach
                    <option value="Others">Others</option>
                </select>
                <div class="form-label-group" id="text" style="display: none;margin-top: 20px">
                  <textarea style="margin-left:0px;height: 100px;margin-bottom: 10px" type="text" id="remarks" class="form-control" placeholder="Specify Reason" name="remarks"></textarea>
                </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Submit</button>  
          </div>
        </form>
      </div>
    </div>
</div>
  
@endsection