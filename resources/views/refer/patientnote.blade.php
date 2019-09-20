@section('style')

<style> 
section {
    padding: 60px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}
#tabs{
  background: #007b5e;
    color: #eee;
}
#tabs h6.section-title{
    color: #eee;
}

#tabs .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
    color: #f3f3f3;
    background-color: transparent;
    border-color: transparent transparent #f3f3f3;
    border-bottom: 4px solid !important;
    font-size: 20px;
    font-weight: bold;
}
#tabs .nav-tabs .nav-link {
    border: 1px solid transparent;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
    color: #eee;
    font-size: 20px;
}
</style>
@endsection

 
<!--
    <div class="modal fade" id="DoctorNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="DoctorNotesModal">Add Doctor Notes</h4>
                              </div>

                            <form id="DocotorNotesFormData" name="DoctorNotesFormData" class="form-horizontal" novalidate="">

                              <div class="modal-body">
                                 <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note" required="required"></textarea>
                                  </div>


                                    
                              </div>    
                                  

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                              </div>
                            </form>

                      </div>
                  </div>
          </div>

   <div class="modal fade" id="NurseNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="NurseNotesModal">Add Nurse Notes</h4>
                              </div>
                          <form id="NurseNotesFormData" name="NurseNotesFormData" class="form-horizontal" novalidate="">
                              <div class="modal-body">
                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                        <option value="">--NONE--</option>
                                          @foreach($service as $services)
                                          @if($services->role == 4)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note" required="required"></textarea>
                                  </div>
                                  

                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-nursenotes" name ="btn-save-nursenotes" value="add">Save changes
                                  </button>
                                    <input type="hidden" id="id" name="id" value="0">
                                    <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                    <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                    <input type="hidden" id="creator_role" name="creator_role" value="doctor">

                           </form>

                              </div>
                  </div>
          </div>
  </div>--!>

<!--Modal for the Check up button-->
<!--   <div class="modal fade" id="AddServiceNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddServiceNotesModal">Add Patient Service</h4>
                              </div>
                              <form id="AddServiceFormData" name="AddServiceFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                      @foreach($service as $services)
                                          <option value="{{$services->id}}"> {{$services->name}}</option>
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="note" class="form-control" placeholder="Note" name="note"></textarea>
                                  </div>
                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-patientnotes" name ="btn-save-patientnotes" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">

                                  <input type="hidden" id="creator_role" name="creator_role" value="doctor">



                              </div>
                  </div>
          </div>
  </div>-->

 <div class="modal fade" id="AddDoctorNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddDoctorNotesModal">Add Doctor Service</h4>
                              </div>
                              <form id="AddDoctorFormData" name="AddDoctorFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes" class="form-control" placeholder="Note" name="notes" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-doctornotes" name ="btn-save-doctornotes" value="add">Save changes
                                  </button>
                                 <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="doctor">


                              </div>
                  </div>
          </div>
  </div>

 <div class="modal fade" id="AddDentalNotesModal" aria-hidden="true" >
      <div class="modal-dialog">
            <div class="modal-content" style="width:800px" >
                  <div class="modal-header" style="width:800px">
                       <h4 class="modal-title" id="AddDentalNotesModal">Add Dental Service</h4>
                  </div>
                       <form id="AddDentalFormData" name="AddDentalFormData" class="form-horizontal" novalidate="">
                  <div class="modal-body" style="width:800px">
                         <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Tooth No.</h6>
                                  <input style="width:30%;" type="textbox" id="Diagnosis" class="form-control" placeholder="Description" required="required" name="Diagnosis">
                                </div>
                            </div>
                        <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Diagnosis</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="Diagnosis" class="form-control" placeholder="Description" required="required" name="Diagnosis">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-label-group">
                                  <h6>Service Rendered</h6>
                                  <input style="height:100px;word-wrap: break-word;" type="textbox" id="Diagnosis" class="form-control" placeholder="Description" required="required" name="Diagnosis">
                                </div>
                              </div>
                            <div class="form-group">
                                        <h6>Remarks</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px;word-wrap: break-word;" type="text" id="note" class="form-control" placeholder="Note" name="note" required="required"></textarea>
                                  </div>

                        </div>
                       </form>
                  <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                  </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="AddSocialWorkerNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddSocialWorkerNotesModal">Add Social Worker Service</h4>
                              </div>
                              <form id="AddSocialWorkerFormData" name="AddSocialWorkerFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes" class="form-control" placeholder="Note" name="notes" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-socialworker" name ="btn-save-socialworker" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>

<div class="modal fade" id="AddPsychiatristNotesModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content" style="width:800px" >
                              <div class="modal-header" style="width:800px">
                                  <h4 class="modal-title" id="AddPsychiatristNotesModal">Add Psychiatrist Service</h4>
                              </div>
                              <form id="AddPsychiatristFormData" name="AddPsychiatristFormData" class="form-horizontal" novalidate="">
                                    
                              <div class="modal-body" style="width:800px">

                                  <div class="form-group">
                                    <h6>Service Type</h6>
                                      <select class="form-control" id="patientList"  name="patientList" data-hide-disabled="true" style="font-size: 16px; width: 500px;margin-left: 0px">
                                          @foreach($service as $services)
                                          @if($services->role == 3)
                                          <option value="{{$services->services->id}}"> {{$services->services->name}}</option>
                                          @endif
                                          @endforeach
                                          </select>
                                  </div>

                                  <div class="form-group">
                                        <h6>Notes</h6>
                                           <textarea style="margin-left:0px;height: 150px;width:760px;margin-bottom: 10px" type="text" id="notes2" class="form-control" placeholder="Note" name="notes2" required="required"></textarea>
                                  </div>


                                    
                              </div>
                            </form>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save-psychiatristnotes" name ="btn-save-psychiatristnotes" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="note_by" name="note_by" value="{{Auth::user()->id}}">
                                  <input type="hidden" id="creator_role" name="creator_role" value="social_worker">



                              </div>
                  </div>
          </div>
  </div>