@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/patient_dep')}}">Choose Department</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/choosef/'.$id)}}">Choose what to fill up</a>
          </li>
          <li class="breadcrumb-item active">Fill up</li>
        </ol>

        <!-- Icon Cards-->
    <div class="container" style="margin-top: 30px">
        <p style="font-size:50px;margin-bottom: 20px">Intake Form</p>
        <form action="{{URL::to('/patientsave_intake')}}" method="post">
          {{csrf_field()}}
          <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px" class="bg bg-dark">Intake Information </legend><legend style="text-indent: 20px;width:1090px;margin-left: 5px"><div class="form-row" style="border-radius: 5px;background-color: #e9ecef">
              <div class="col-md-4 mb-4">
                <div class="form-label-group" style="margin-top: 20px">
                  <h6>Patient Type*</h6>
                <select class="form-control" id="ptype" placeholder="Patient Type" required="required" name="ptype" style="margin-left: 20px">
                  @foreach($case as $cases)
                    <option value="" disabled selected hidden>Patient Type</option>
                    <option id="{{$cases->court_order}}" value="{{$cases->id}}">{{$cases->case_name}}</option>
                  @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="form-label-group" id="textas" style="display: none;margin-top: 20px">
                  <h6>City Jail*</h6>
                <select class="form-control" id="jail" placeholder="Patient Type" required="required" name="jail" style="margin-left: 20px">
                @foreach($jails as $jail)
                    <option value="" disabled selected hidden>City Jail</option>
                    <option value="{{$jail->id}}">{{$jail->name}}</option>
                @endforeach
                </select>
                </div>
              </div>
              <div class="col-md-3 mb-4">
                <div class="form-label-group" id="text" style="display: none;margin-top: 20px">
                  <h6>Case Number*</h6>
                    <input type="text" id="caseno" class="form-control" placeholder="Case Number" required="required" autofocus="autofocus" name="caseno" value="" style="margin-left: 20px">
                </div>
              </div>
            </div></legend>
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
              <div class="col-md-3">
                <div class="form-label-group">
                   <h6>Middle Name*</h6>
                  <input type="text" id="mname" class="form-control" placeholder="Middle Name" required="required" autofocus="autofocus" name="mname" value="{{ old('mname') }}">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Birthday*</h6>
                  <input type="date" id="bday" class="form-control" placeholder="Birthday" required="required" autofocus="autofocus" name="bday">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="department" value="{{$id}}">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-row">
              <div class="col-md-3">
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
            <div class="col-md-2">
                <div class="form-label-group">
                   <h6>Marital Status*</h6>
                 <select class="form-control" id="civils" placeholder="Civil Status" required="required" name="civils">
                  <label for="civils">Civil Status</label>
                    <option value="" disabled selected hidden>Marital Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                </select>
                </div>
              </div>
          </div>
        </div>
        </fieldset>
        <fieldset>
            <div class="form-group" style="margin-left:20px">
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
                           <input type="text" id="emername" class="form-control" placeholder="Last name"  name="emername">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Relationship*</h6>
                              <input type="text" id="emerelation" class="form-control" placeholder="Last name"  name="emerelation">
                           </div>
                         </div>
                       </div>
                      </div>
                  <div class="form-group">
                    <div class="form-row">
                     <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Phone No.(Home)*</h6>
                       <input type="text" id="emerphone" class="form-control" placeholder="Last name"  name="emerphone">
                     </div>
                   </div>
                   <div class="col-md-6">
                     <div class="form-label-group">
                      <h6>Cellphone No.*</h6>
                       <input type="text" id="emercell" class="form-control" placeholder="Last name"  name="emercell">
                     </div>
                   </div>
                    </div>
                  </div>
                   <div class="form-group">
                      <div class="form-label-group">
                      <h6>Email add*</h6>
                       <input type="text" id="emeremail" class="form-control" placeholder="Last name"  name="emeremail">
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
                          <select class="form-control" id="eduattain" placeholder="Civil Status" required="required" name="eduattain">
                            <label for="eduattain">Educational Attainment</label>
                            <option value="" disabled selected hidden>--Choose--</option>
                            <option value="Elementary">Elementary Graduate</option>
                            <option value="Highschool">High-school Graduate</option>
                            <option value="College">College Graduate</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-label-group">
                          <h6>Employement Status*</h6>
                           <select class="form-control" id="edstat" placeholder="Civil Status" required="required" name="edstat">
                            <label for="edstat">Employement Status</label>
                            <option value="" disabled selected hidden>--Choose--</option>
                            <option value="Employed">Employed</option>
                            <option value="Unemployed">Unemployed</option>
                        </select>
                        </div>
                      </div>
                     </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-9">
                        <div class="form-label-group">
                          <h6>Name of Spouse*</h6>
                          <input type="text" id="spouse" class="form-control" placeholder="Chief Complaint" name="spouse">
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
                           <input type="text" id="fathname" class="form-control" placeholder="Last name"  name="fathname">
                         </div>
                        </div>
                         <div class="col-md-6">
                           <div class="form-label-group">
                             <h6>Mother's name*</h6>
                              <input type="text" id="mothname" class="form-control" placeholder="Last name"  name="mothname">
                             </div>
                           </div>
                        </div>
                        </div>
                      </div>
                    </div>
                 </div>
                </div>
              </div>
          <div class="form-group" style="margin-left:20px">
            <div class="form-label-group">
              <h6>Presenting Problems*</h6>
              <textarea type="text" id="preprob" class="form-control" placeholder="Please Specify" name="preprob"></textarea>
            </div>
          </div>
          <div class="form-group" style="margin-left:20px">
                <div class="form-label-group">
                  <h6>Impression*</h6>
                  <textarea style="height: 120px" type="text" id="impre" class="form-control" placeholder="Please Specify" name="impre"></textarea>
              </div>
          </div>
        </fieldset>
           <input style="width:200px;height:50px;float:right;margin-top: 10px;margin-bottom: 30px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
         </form>
    </div>

       
@endsection
