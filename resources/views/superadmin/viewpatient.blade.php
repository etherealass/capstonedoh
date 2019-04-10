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
      @if($stat == 1)
        @foreach($pat as $pats)
          @if($pats->department_id != Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
            @foreach($transfers as $trans)
              @if($trans->status == "")   
        <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:550px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
        </ol>
              @elseif(Auth::user()->department == $pats->department_id || Auth::user()->user_role->first()->name == 'Superadmin')
          <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
          <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
    
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
            @foreach($transfer as $trans)
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
      @elseif($stat == 0)
        @foreach($pat as $pats)
          @if($pats->department_id == Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
            @foreach($graduates as $grads)
              @if($grads->status == "")
         <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-warning">For Graduation</span></h4></p>
          </div>
          <div class="col-md-4">
          </div>
          <div class="col-md-3" style="margin-top: 10px">
              <a href="{{URL::to('graduate_patient_now/'.$pats->id.'/'.$grads->in_department.'/'.$grads->graduate_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:50px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Graduate</p></a>
              <a href="{{URL::to('declinet_patient_now/'.$pats->id.'/'.$grads->in_department.'/'.$grads->graduate_id.'/'.$pid)}}" class="btn btn-danger" style="margin-left:10px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Decline</p></a>
          </div>
         </div>
              @elseif(Auth::user()->department == $pats->department_id || Auth::user()->user_role->first()->name == 'Superadmin')
          <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
              <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
          </ol>
            @endif
          @endforeach

      @include('flash::message')
        <!-- Icon Cards-->
          <div class="row" style="margin-left: 0px;">
           <div style="">
            <div class="col-md-12 scrollAble2" style="margin-right: 0px">
             <ul class="sidebar navbar-nav" style="background-color:white;">
              <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 10px;height: 45px"><h6>Information</h6></a>
                </li>
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>Refer</h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>Sessions</h6></a>
                </li>
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>History</h6></a>
                </li>
               <li class="nav-item"  id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="margin-top: 10px">
                <a class="nav-link active bg-dark" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Intake</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>Doctor's Progress Notes</h6></a>
                </li>
            </ul>
            </div>
          </div>
            <div class="col-md-9" style="margin-top: 10px">
              <div class="tab-content" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                  <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Graduate Remarks</legend>
                  <div class="container" style="margin-left: 10px">
                    <div class="row">
                      <div class="col-md-2">
                        @foreach($graduates as $grads)
                        <p style="font-size: 8px"><h6>{{$grads->remarks}}</h6></p>
                        @endforeach
                      </div>
                   </div>
                 </div>
                </fieldset>
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
                    <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Doctor's Progress Notes <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('sampleform/'.$pats->id)}}" target="_blank"><button class="btn btn-danger"><i class="fas fa-fw fa fa-print"></i>Print</button></a></div></legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-12">
                         <div class="table-responsive scrollAble2">
                          <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                            <thead>
                             <tr>
                               <th>Date/Time</th>
                               <th>Notes</th>
                            </tr>
                            </thead>
                          <tbody>
                          </tbody>
                        </table>
                        </div>
                      </div>
                      </div>
                     </div>
                </fieldset>
                </div>
                <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
              <div class="container scrollAble2" style="margin-top: 30px">
                <form action="{{URL::to('/patientsave_intake')}}" method="post">
                  {{csrf_field()}}
                  <fieldset style="margin-bottom: 30px">
                      <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
                    <div class="form-group" style="margin-left:20px">
                      <div class="form-row">
                        <div class="col-md-4">
                          <div class="form-label-group">
                            <h6>Last name*</h6>
                            <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}" disabled="true">
                          </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>First name*</h6>
                            <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}" disabled="true">
                        </div>
                      </div>
                    <div class="col-md-1">
                      <div class="form-label-group">
                        <h6>Age*</h6>
                          <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{$pats->age}}" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-label-group">
                        <h6>Birthday*</h6>
                          <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}" disabled="true">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="department" value="{{$pats->id}}">
                      </div>
                    </div>
                </div>
              </div>
            <div class="form-group" style="margin-left:20px">
                <div class="form-row">
                  <div class="col-md-3">
                    <div class="form-label-group">
                      <h6>Street Address*</h6>
                      <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}" disabled="true">
                    </div>
                  </div>
                <div class="col-md-3  ">
                  <div class="form-label-group">
                    <h6>Barangay*</h6>
                    <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <h6>City*</h6>
                    <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-label-group">
                    <h6>Marital Status*</h6>
                    <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils" value="{{$pats->civil_status}}" disabled="true">
                      <label for="civils">Civil Status</label>
                      <option value="Single" {{ ($pats->civil_status == 'Single') ? 'selected' : '' }}>Single</option>
                      <option value="Married" {{ ($pats->civil_status == 'Married') ? 'selected' : '' }}>Married</option>
                      <option value="Separated" {{ ($pats->civil_status == 'Separated') ? 'selected' : '' }}>Separated</option>
                      <option value="Divorced" {{ ($pats->civil_status == 'Divorced') ? 'selected' : '' }}>Divorced</option>
                      <option value="Widowed" {{ ($pats->civil_status == 'Widowed') ? 'selected' : '' }}>Widowed</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                          @foreach($patos as $patss)
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}" disabled="true">
                            @endforeach
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}" disabled="true">
                      @endforeach
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          @foreach($patos as $patss)
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain" disabled="true">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="Elementary" {{ ($patss->educational_attainment == 'Elementary') ? 'selected' : '' }}>Elementary Graduate</option>
                            <option value="Highschool" {{ ($patss->educational_attainment == 'Highschool') ? 'selected' : '' }}>High-school Graduate</option>
                            <option value="College" {{ ($patss->educational_attainment == 'College') ? 'selected' : '' }}>College Graduate</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                          @foreach($patos as $patss)
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat" disabled="true">
                            <label for="edstat">Employement Status</label>
                            <option value="Employed"  {{ ($patss->employment_status == 'Employed') ? 'selected' : '' }}>Employed</option>
                            <option value="Unemployed"  {{ ($patss->employment_status == 'Unemployed') ? 'selected' : '' }}>Unemployed</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          @foreach($patos as $patss)
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}" disabled="true">
                          @endforeach
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                          @foreach($patos as $patss)
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}" disabled="true">
                            @endforeach
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              @foreach($patos as $patss)
              <textarea type="text" id="preprob" class="form-control" placeholder="{{$patss->presenting_problems}}" name="preprob" value="{{$patss->presenting_problems}}" disabled="true"></textarea>
              @endforeach
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  @foreach($patos as $patss)
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="{{$patss->impression}}" name="impre" value="{{$patss->impression}}" disabled="true"></textarea>
                  @endforeach
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
  </fieldset>
        </div>
         <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
          <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
             <div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/patientsave_dde')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Personal Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{!! old('lname') !!}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{ old('fname') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" required="required" name="mname" value="{{ old('mname') }}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{ old('age') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birth Order*</h6>
                  <input type="number" id="border" class="form-control" placeholder="" required="required" autofocus="autofocus" name="border">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city">
            </div>
           </div>
          </div>
        </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Contact no.*</h6>
                  <input type="tel" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" value="{{$pats->id}}">
              </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Gender*</h6>
                 <select class="form-control" id="gender" placeholder="Gender" required="required" name="gender">
                    <option value="" disabled selected hidden>Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="Others">Others</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  <label for="civils">Civil Status</label>
                    <option value="" disabled selected hidden>Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Nationality*</h6>
                <input type="text" id="nation" class="form-control" placeholder="Nationality" required="required" name="nation">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Religion*</h6>
                <input type="text" id="religion" class="form-control" placeholder="Nationality" required="required" name="religion">
                </div>
              </div>
            </div>
          </div>
        </fieldset> 
        <fieldset>
        <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 20px" class="bg bg-dark">General Information</legend>
        <div class="container border border-gray" style="margin-bottom: 20px;margin-top: 10px">
          <div class="form-group" style="margin-top: 10px">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px">
                    <input type="radio" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ (old('casetype') == 'New Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="new case"><h6>New Case</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ (old('casetype') == 'Old Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="old case"><h6>Old Case</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ (old('casetype') == 'With Court Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="case"><h6>With Court Case</h6></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-label-group">
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px">
                    <input type="radio" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ (old('type') == 'Voluntary Submission') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Voluntary Submission"><h6>Voluntary Submission</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ (old('type') == 'Compulsory Submission') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Compulsory Submission"><h6>Compulsory Submission</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="others"><h6>Others</h6></label>
                   </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-4">
                      <div class="form-label-group" id="textboxes" style="display: none;">
                          <input style="margin-left:0px" type="text" id="casetype" class="form-control" placeholder="Specify Nature/Case no." name="casetype">
                          <label for="casetype" style="margin-left:0px">Specify Nature/Case no.</label>
                      </div>
                      <div class="form-label-group" id="textback"></div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group" id="textbox" style="display: none;">
                        <input style="margin-left:180px" type="text" id="type" class="form-control" placeholder="Please Specify" name="type">
                        <label for="type" style="margin-left:180px">Please specify</label>
                    </div>
                      <div class="form-label-group" id="textbax"></div>
                  </div>
                </div>
              </div>
            </div>
          <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background"></textarea>
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
        </fieldset>
    </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      @endif
      @else
        @foreach($pat as $pats)
          @if($pats->department_id == Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
            @if($pats->status == 'Enrolled')
        <div class="row">
          <div class="col-md-4" style="margin-left: 28px;margin-right: 60px">
            <p><h1 style="color:#343a40">Patient No. {{$pats->id}}</h1><br><h4 style="color:#343a40"> Patient Status: <span class="text-primary">Enrolled</span></p>
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-4" style="margin-top: 10px">
    
                <button class="btn btn-success" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}" data-toggle="modal" data-target="#patientadminGraduate" style="margin-left:10px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" data-toggle="modal" data-patientdep="{{$pats->department_id}}" data-patientid="{{$pats->id}}" data-target="#patientDismiss" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
    
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
            
              <li class="breadcrumb-item active" style="margin-left: 10px"><i class="fas fa-fw fa fa-user"></i><span><h3>---Pending---<h3></span></li>
        
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
        
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-toggle="modal" data-target="#patientadminReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
        
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
        
              <button class="btn btn-primary" data-patientid="{{$pats->id}}" data-toggle="modal" data-target="#patientadminReenroll" style="margin-left:60px;height: 60px;width: 90px;margin-top: 10px">Re-enroll</button>
        
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
                  <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Information</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Refer</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-contact-tab" data-toggle="pill" href="#v-pills-contact" role="tab" aria-controls="v-pills-contact" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Sessions</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>History</span></h6></a>
                </li>
                <li class="nav-item"  id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="margin-top: 10px">
                  <a class="nav-link active bg-dark" id="v-pills-intake-tab" data-toggle="pill" href="#v-pills-intake" role="tab" aria-controls="v-pills-intake" aria-selected="true" style="color:white;margin-bottom: 5px;height: 45px;text-align: center;border-radius: 5px"><h6><span>Intake</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="">
                  <a class="nav-link bg-dark" id="v-pills-dde-tab" data-toggle="pill" href="#v-pills-dde" role="tab" aria-controls="v-pills-dde" aria-selected="false" style="color:white;margin-bottom: 5px;height: 75px;text-align: center;border-radius: 5px"><h6><span>Drug Dependency Examination</span></h6></a>
                </li>
                <li class="nav-item" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false">
                  <a class="nav-link bg-dark" id="v-pills-doctornote-tab" data-toggle="pill" href="#v-pills-doctornote" role="tab" aria-controls="v-pills-doctornote" aria-selected="false" style="color:white;margin-bottom: 5px;height: 65px;text-align: center;border-radius: 5px"><h6><span>Doctor's Progress Notes</span></h6></a>
                </li>
            </ul>
            </div>
          </div>
            <div class="col-md-9" style="margin-top: 10px">
              <div class="tab-content" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                       <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                    <div class="container" style="margin-left: 0px">
                      <div class="row">
                        <div class="col-md-3">
                          <p style="font-size: 8px"><h6>Name:</h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                         </div>
                       <div class="col-md-3">
                          <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                       </div>
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                      </div>
                      <div class="col-md-3">
                       <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                      </div>
                      <div class="col-md-3">
                         <p style="font-size: 8px"><h6>Age:</h6> {{$pats->age}}</p>
                      </div>
                      @if($pats->birthorder != NULL)
                      @if($pats->birthorder != 'NULL')
                      <div class="col-md-3">
                        <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                      </div>
                      @endif
                    @if($pats->contact != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                    </div>
                    @endif
                    @if($pats->nationality != 'NULL')
                    <div class="col-md-3">
                      <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                    </div>
                   @endif
                  @if($pats->religion != 'NULL')
                   <div class="col-md-3" style=""> 
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
                            <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a href="{{URL::to('samplecsv')}}"><button class="btn btn-success"><i class="fas fa-fw fa fa-file-csv"></i>CSV</button></a></div>
                           @if(Auth::user()->user_role->name == 'Doctor' || Auth::user()->user_role->name == 'Superadmin')
                          <div style="float:right;margin-bottom: 10px;margin-right: 10px;margin-top: 10px"><a data-patientid="{{$pats->id}}" data-doctorid="{{Auth::user()->id}}" data-toggle="modal" data-target="#addNotes"><button class="btn btn-success"><i class="fas fa-fw fa fa-plus"></i>Add Notes</button></a></div>
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
        <div class="tab-pane fade" id="v-pills-intake" role="tabpanel" aria-labelledby="v-pills-intake-tab">
          <fieldset style="margin-bottom: 10px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 10px;border-radius: 5px" class="bg bg-dark">Intake Form </legend>
              <div class="container scrollAble2" style="margin-top: 30px">
                <form action="{{URL::to('/patientsave_intake')}}" method="post">
                  {{csrf_field()}}
                  <fieldset style="margin-bottom: 30px">
                      <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Intake Information</legend>
                    <div class="form-group" style="margin-left:20px">
                      <div class="form-row">
                        <div class="col-md-4">
                          <div class="form-label-group">
                            <h6>Last name*</h6>
                            <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{{$pats->lname}}" disabled="true">
                          </div>
                        </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>First name*</h6>
                            <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{$pats->fname}}" disabled="true">
                        </div>
                      </div>
                    <div class="col-md-1">
                      <div class="form-label-group">
                        <h6>Age*</h6>
                          <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{$pats->age}}" disabled="true">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-label-group">
                        <h6>Birthday*</h6>
                          <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday" value="{{$pats->birthdate}}" disabled="true">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          <input type="hidden" name="department" value="{{$pats->id}}">
                      </div>
                    </div>
                </div>
              </div>
            <div class="form-group" style="margin-left:20px">
                <div class="form-row">
                  <div class="col-md-3">
                    <div class="form-label-group">
                      <h6>Street Address*</h6>
                      <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street" value="{{$pats->address->street}}" disabled="true">
                    </div>
                  </div>
                <div class="col-md-3  ">
                  <div class="form-label-group">
                    <h6>Barangay*</h6>
                    <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay" value="{{$pats->address->barangay}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-label-group">
                    <h6>City*</h6>
                    <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city" value="{{$pats->address->city}}" disabled="true">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-label-group">
                    <h6>Marital Status*</h6>
                    <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils" value="{{$pats->civil_status}}" disabled="true">
                      <label for="civils">Civil Status</label>
                      <option value="Single" {{ ($pats->civil_status == 'Single') ? 'selected' : '' }}>Single</option>
                      <option value="Married" {{ ($pats->civil_status == 'Married') ? 'selected' : '' }}>Married</option>
                      <option value="Separated" {{ ($pats->civil_status == 'Separated') ? 'selected' : '' }}>Separated</option>
                      <option value="Divorced" {{ ($pats->civil_status == 'Divorced') ? 'selected' : '' }}>Divorced</option>
                      <option value="Widowed" {{ ($pats->civil_status == 'Widowed') ? 'selected' : '' }}>Widowed</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
        </fieldset>
        <fieldset>
            <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Whom to notify in case of emergency:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                          @foreach($patos as $patss)
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername" value="{{$patss->eperson->name}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation" value="{{$patss->eperson->relationship}}" disabled="true">
                            @endforeach
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone" value="{{$patss->eperson->phone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell" value="{{$patss->eperson->cellphone}}" disabled="true">
                      @endforeach
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                      @foreach($patos as $patss)
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail" value="{{$patss->eperson->email}}" disabled="true">
                      @endforeach
                    </div>
                  </div>
                  </div>
                 </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-5">
                        <div class="form-label-group">
                          <h6>Educational Attainment*</h6>
                          @foreach($patos as $patss)
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain" disabled="true">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="Elementary" {{ ($patss->educational_attainment == 'Elementary') ? 'selected' : '' }}>Elementary Graduate</option>
                            <option value="Highschool" {{ ($patss->educational_attainment == 'Highschool') ? 'selected' : '' }}>High-school Graduate</option>
                            <option value="College" {{ ($patss->educational_attainment == 'College') ? 'selected' : '' }}>College Graduate</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                          @foreach($patos as $patss)
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat" disabled="true">
                            <label for="edstat">Employement Status</label>
                            <option value="Employed"  {{ ($patss->employment_status == 'Employed') ? 'selected' : '' }}>Employed</option>
                            <option value="Unemployed"  {{ ($patss->employment_status == 'Unemployed') ? 'selected' : '' }}>Unemployed</option>
                        </select>
                        @endforeach
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name Of Spouse*</h6>
                          @foreach($patos as $patss)
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse" value="{{$patss->spouse}}" disabled="true">
                          @endforeach
                        </div>
                      </div>
                   </div>
                </div>
                <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Parents:</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Father's name*</h6>
                          @foreach($patos as $patss)
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname" value="{{$patss->father}}" disabled="true">
                          @endforeach
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                             @foreach($patos as $patss)
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname" value="{{$patss->mother}}" disabled="true">
                            @endforeach
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              @foreach($patos as $patss)
              <textarea type="text" id="preprob" class="form-control" placeholder="{{$patss->presenting_problems}}" name="preprob" value="{{$patss->presenting_problems}}" disabled="true"></textarea>
              @endforeach
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  @foreach($patos as $patss)
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="{{$patss->impression}}" name="impre" value="{{$patss->impression}}" disabled="true"></textarea>
                  @endforeach
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
  </fieldset>
        </div>
         <div class="tab-pane fade" id="v-pills-dde" role="tabpanel" aria-labelledby="v-pills-dde-tab">
          <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
            <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Drug Dependency Examination Report</legend>
             <div class="container scrollAble2" style="margin-top: 30px">
        <form action="{{URL::to('/patientsave_dde')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Personal Information</legend>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                  <h6>Last name*</h6>
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" autofocus="autofocus" name="lname" value="{!! old('lname') !!}">
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>First name*</h6>
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" name="fname" value="{{ old('fname') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Middle name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" required="required" name="mname" value="{{ old('mname') }}">
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-label-group">
                   <h6>Age*</h6>
                  <input type="number" id="age" class="form-control" placeholder="Age" required="required" autofocus="autofocus" name="age" value="{{ old('age') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birth Order*</h6>
                  <input type="number" id="border" class="form-control" placeholder="" required="required" autofocus="autofocus" name="border">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-label-group">
               <h6>Street Address*</h6>
              <input type="text" id="street" class="form-control" placeholder="Address" required="required" name="street">
            </div>
           </div>
            <div class="col-md-3  ">
              <div class="form-label-group">
               <h6>Barangay*</h6>
              <input type="text" id="barangay" class="form-control" placeholder="Address" required="required" name="barangay">
            </div>
           </div>
           <div class="col-md-3">
              <div class="form-label-group">
               <h6>City*</h6>
              <input type="text" id="city" class="form-control" placeholder="Address" required="required" name="city">
            </div>
           </div>
          </div>
        </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Contact no.*</h6>
                  <input type="tel" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" value="{{$pats->id}}">
              </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Gender*</h6>
                 <select class="form-control" id="gender" placeholder="Gender" required="required" name="gender">
                    <option value="" disabled selected hidden>Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="Others">Others</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Civil Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  <label for="civils">Civil Status</label>
                    <option value="" disabled selected hidden>Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Nationality*</h6>
                <input type="text" id="nation" class="form-control" placeholder="Nationality" required="required" name="nation">
                </div>
              </div>
               <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Religion*</h6>
                <input type="text" id="religion" class="form-control" placeholder="Nationality" required="required" name="religion">
                </div>
              </div>
            </div>
          </div>
        </fieldset> 
        <fieldset>
        <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 20px" class="bg bg-dark">General Information</legend>
        <div class="container border border-gray" style="margin-bottom: 20px;margin-top: 10px">
          <div class="form-group" style="margin-top: 10px">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px">
                    <input type="radio" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ (old('casetype') == 'New Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="new case"><h6>New Case</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ (old('casetype') == 'Old Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="old case"><h6>Old Case</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ (old('casetype') == 'With Court Case') ? 'unchecked' : '' }}>
                    <label class="custom-control-label" for="case"><h6>With Court Case</h6></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6">
                <div class="form-label-group">
                  <div class="custom-control custom-radio custom-control-inline" style="font-size: 50px">
                    <input type="radio" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ (old('type') == 'Voluntary Submission') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Voluntary Submission"><h6>Voluntary Submission</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ (old('type') == 'Compulsory Submission') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="Compulsory Submission"><h6>Compulsory Submission</h6></label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="others"><h6>Others</h6></label>
                   </div>  
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-4">
                      <div class="form-label-group" id="textboxes" style="display: none;">
                          <input style="margin-left:0px" type="text" id="casetype" class="form-control" placeholder="Specify Nature/Case no." name="casetype">
                          <label for="casetype" style="margin-left:0px">Specify Nature/Case no.</label>
                      </div>
                      <div class="form-label-group" id="textback"></div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-label-group" id="textbox" style="display: none;">
                        <input style="margin-left:180px" type="text" id="type" class="form-control" placeholder="Please Specify" name="type">
                        <label for="type" style="margin-left:180px">Please specify</label>
                    </div>
                      <div class="form-label-group" id="textbax"></div>
                  </div>
                </div>
              </div>
            </div>
          <div class="form-group">
              <div class='form-row'>
                <div class="col-md-6">
                  <div class="card card-register mx-auto" style="margin-bottom: 20px">
                    <div class="card-header"><h6>Accompanied by/Informant</h6></div>
                     <div class="card-body">
                      <div class="form-group">
                       <div class="form-row">
                        <div class="col-md-6">
                         <div class="form-label-group">
                          <h6>Name*</h6>
                           <input type="text" id="infoname" class="form-control" placeholder="Last name"  name="infoname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Contact no.*</h6>
                              <input type="text" id="infocontact" class="form-control" placeholder="Last name"  name="infocontact">
                           </div>
                         </div>
                       </div>
                      </div>
                    <div class="form-group">
                     <div class="form-label-group">
                      <h6>Address*</h6>
                       <input type="text" id="infoadd" class="form-control" placeholder="Last name"  name="infoadd">
                     </div>
                    </div>
                  </div>
                 </div>
               </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <h6>Referred By*</h6>
                    <input type="text" id="referred" class="form-control" placeholder="Referred By" name="referred">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                   <h6>Drug Abused (Present)*</h6>
                  <input type="text" id="dabused" class="form-control" placeholder="Drugs Abused (Present)" autofocus="autofocus" name="dabused">
                </div>
              </div>
              </div>
            </div>
            <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
              <div class="form-label-group">
                 <h6>Chief Complaint*</h6>
                  <input type="text" id="ccomplaint" class="form-control" placeholder="Chief Complaint" name="ccomplaint">
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
          <div class="form-group">
            <div class="form-label-group">
              <h6>History of Present Illness*</h6>
              <textarea type="text" id="pillness" class="form-control" placeholder="Please Specify" name="pillness"></textarea>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>History of Drug Used*</h6>
                  <textarea style="height: 120px" type="text" id="dused" class="form-control" placeholder="Please Specify" name="dused"></textarea>
              </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <h6>Family/Personal Background*</h6>
                  <textarea style="height:200px" type="text" id="background" class="form-control" placeholder="Please Specify" name="background"></textarea>
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>
        </fieldset>
    </div>
        </div>
      </div>
    </div>
  </div>
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