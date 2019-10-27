 <!DOCTYPE html>
 <html>
 <body>
 <div class="container" style="margin-top: 60px;margin-bottom: 30px">
                      <div class="container">
                        <div style="margin-top:30px">
                          <img src="http://localhost/capstone/public/images/logo3.png" height="100px" width="100px" style="float:left;">
                          <p style="text-align:center;position:relative;"><b style="font-size: 25px">TREATMENT & REHABILITATION CENTER - CEBU</b><br><span style="font-size:20px">Drug Dependency Examination Report</span></p>
                        </div>
    @foreach($pat as $pats)
            <div class="row" style="margin-top: 50px;padding:20px">
              <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px;border-right: none">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                  <?php $count = 0 ?>
                  @foreach($history as $hist)
                    @if($hist->type == 'Enrolled')
                      @if($hist->deps->department_name == $pats->departments->department_name)
                      <?php $count++; ?>
                      @endif
                    @endif
                  @endforeach
                    <input type="checkbox" class="custom-control-input" id="new case" name="casetype" value="New Case" {{ ($count != 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="new case"><b>Old Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="old case" name="casetype" value="Old Case" {{ ($count == 1)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="old case"><b>New Case</b></label>
                  </div>
                </div>
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="case" name="casetype" value="With Court Case" {{ ($pats->caseno != NULL)? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="case"><b>With Court Case:</b>
                  @if($pats->caseno != NULL)
                    <b><u> {{$pats->caseno}}</u></b>
                  @else
                    ________________________________________
                  @endif
                    </label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-6" style="border: solid gray 1px;padding:20px;font-size: 12px">
                <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline" style="font-size: 50px">
                    <input type="checkbox" class="custom-control-input" id="Voluntary Submission" name="type" value="Voluntary Submission" {{ ($pats->type->case_name == 'Voluntary' || $pats->type->case_name == 'Voluntary with Court Order')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Voluntary Submission"><b>Voluntary Submission</b></label>
                  </div>
                </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="Compulsory Submission" name="type" value="Compulsory Submission" {{ ($pats->type->case_name == 'Plea Bargain')? "checked" : "" }} disabled="true">
                    <label class="custom-control-label" for="Compulsory Submission"><b>Compulsory Submission</b></label>
                  </div>
                  </div>
                  <div class="form-label-group">
                  <div class="custom-control custom-checkbox custom-control-inline">
                    <input type="checkbox" class="custom-control-input" id="others" name="type" value="Others" {{ (old('type') == 'Others') ? 'checked' : '' }} disabled="true">
                    <label class="custom-control-label" for="others"><b>Others: ___________________________________</b></label>
                   </div>  
                  </div>
                </div>
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px;border-top:none;border-right:none">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <b><p>Last name:</p></b>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->lname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;">
                    <b><p>Address:</p></b>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>First name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->fname}}</p>
                  </div>
                  <div class="col-md-6" style="border-right: solid gray 1px;border-bottom: solid gray 1px;">
                    <p>{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                  </div>
                 </div>
                  <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Middle name:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->mname}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Contact Number:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->contact}}</p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Age:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{\Carbon\Carbon::parse($pats->birthdate)->age}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Gender:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birthdate:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthdate}}</p>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Civil Status:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Birth Order:</b></p>
                  </div>
                  <div class="col-md-3" style="border-bottom: solid gray 1px;border-right: solid gray 1px">
                    <p>{{$pats->birthorder}}</p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p><b>Nationality:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-bottom: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                 <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Religion:</b></p>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px">
                    <p></p>
                  </div>
                 </div>
                </div> 
              </div>
              @endforeach
              <div class="row" style="padding:20px">
                <div class="col-md-12" style="border: solid gray 1px;font-size: 12px">
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;">
                    <p><b>Referred by:</b></p>
                  </div>
                  <div class="col-md-9" style="border-right: none">
                    <p></p>
                  </div>
                </div>
              @if($patis != '[]')
                @foreach($patis as $patin)
                <div class="row">
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Accompanied By/<br>Informant</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                      <div class="col-md-6"><b>Name:</b> {{$patin->informants->name}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Address:</b> {{$patin->informants->address}}</div>
                    </div>
                    <div class="row">
                      <div class="col-md-5"><b>Signature:</b> _____________________________</div>
                      <div class="col-md-5"><b>Contact no:</b> {{$patin->informants->contact}}</div>
                    </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>DRUGS ABUSED<br>(Present)</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->drugs_abused}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>Chief Complaint</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->chief_complaint}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px">
                    <p><b>History of Present<br>Illness</b></p>
                  </div>
                   <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_present_illness}}</div>
                   </div>
                  </div>
                   <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>History of Drug<br>Use</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->h_drug_abuse}}</div>
                   </div>
                  </div>
                  <div class="col-md-3" style="border-right: solid gray 1px;border-top: solid gray 1px;padding:10px;height: 100px">
                    <p><b>Family/Personal<br>History</b></p>
                  </div>
                  <div class="col-md-9" style="border-top: solid gray 1px;padding-top: 10px">
                    <div class="row">
                     <div class="col-md-9">{{$patin->famper_history}}</div>
                   </div>
                  </div>
                </div>
                 @endforeach  
                 @endif

