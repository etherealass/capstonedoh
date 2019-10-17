
<div class="modal fade" id="linkEditorModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="linkEditorModalLabel">Referal Slip (Two Way Referal System)</h4>
                              </div>
                              <div class="modal-body">
                                   <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                                     <table style="width:100%">
                                      <tr>
                                      <td style="width:25%">Last Name:</th>
                                      <td style="width:25%">{{$pats->lname}}</td>
                                      <td style="width:25%" colspan="2" rowspan="2">Address: &emsp;{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">First Name:</td><td style="width:25%"> {{$pats->fname}}</td>
                                        </tr>
        
                                       <tr>
                                        <td style="width:25%">Case New( ) old ( )</td>
                                        <td style="width:25%">Middle initial:  &emsp; {{$pats->mname}}</td>
                                        <td style="width:25%">Contact Number:</td>
                                        <td style="width:25%">{{$pats->contact}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">Age:</td>
                                      <td style="width:25%">{{$pats->age}}</td>
                                      <td style="width:25%">Gender:</td>
                                      <td style="width:25%">{{$pats->gender}}</td>
                                      </tr>
        
                                        <tr>
                                        <td style="width:25%">Birthdate:</td>
                                        <td style="width:25%">{{$pats->birthdate}}</td>
                                        <td style="width:25%">Date of referral:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" value="<?php echo $today; ?>" id="refDate" name="refDate" required></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Refered at:</td>
                                        <td style="width:25%"><input type="text" style="height:70px; width: 230px;"  id="refAt" name="refAt"  /></td>
                                        <td style="width:25%">Reason for Referral:</td>
                                        <td style="width:25%"><input style="height:70px; width: 230px;" type="text" id="reason" name="reason" required="required" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Contact Person:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="contactPer" name="contactPer" required="required"></td>
                                        <td style="width:25%">Refered by: </td>
                                        <td style="width:25%"><input  style="width: 230px;" type="text" id="refby" name="refby" value="{{Auth::user()->id}}" hidden="hidden"><input  style="width: 230px;" type="text" id="refby2" name="refby2" value="{{Auth::user()->fname}} {{Auth::user()->lname}}" disabled="disabled"></td>
                                        </tr>
                                        
                                        <tr>
                                        <td height="70px" colspan="4"><label> Recommendation/Attachments: </label> &emsp;<input style="height:70px; width: 670px;" type="text" id="ref_recom" name="ref_recom" required="required"/></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Refered back on(date)</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="refDateback" name="refDateback" ></td>
                                        <td style="width:25%">Refered back by:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="refbyback" name="refbyback" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Accepted by:</td>
                                        <td style="width:25%"></td>
                                        <td style="width:25%">Referal slip return on</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="returnDate" name="returnDate" ></td>
                                        </tr>
                                        
                                        
                                      </table>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="user_accepted" name="user_accepted" value="{{Auth::user()->id}}">


                              </div>
                  </div>
          </div>
  </div>


                       <!--modal for Refer Button-->
  <div class="modal fade" id="viewModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="viewModalLabel">Referal Slip (Two Way Referal System)</h4>
                              </div>
                              <div class="modal-body">
                                   <form id="viewFormData" name="viewFormData" class="form-horizontal" novalidate="">
                                     <table style="width:100%">
                                      <tr>
                                      <td style="width:25%">Last Name:</th>
                                      <td style="width:25%">{{$pats->lname}}</td>
                                      <td style="width:25%" colspan="2" rowspan="2">Address: &emsp;{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">First Name:</td><td style="width:25%"> {{$pats->fname}}</td>
                                        </tr>
        
                                       <tr>
                                        <td style="width:25%">Case New( ) old ( )</td>
                                        <td style="width:25%">Middle initial:  &emsp; {{$pats->mname}}</td>
                                        <td style="width:25%">Contact Number:</td>
                                        <td style="width:25%">{{$pats->contact}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">Age:</td>
                                      <td style="width:25%">{{$pats->age}}</td>
                                      <td style="width:25%">Gender:</td>
                                      <td style="width:25%">{{$pats->gender}}</td>
                                      </tr>
        
                                        <tr>
                                        <td style="width:25%">Birthdate:</td>
                                        <td style="width:25%">{{$pats->birthdate}}</td>
                                        <td style="width:25%">Date of referral:</td>
                                        <td style="width:25%">

                                        <input style="width: 230px;" class="myinput" type="date" value="<?php echo $today; ?>" id="refDate" name="refDate" readonly="readonly" class="myinput" ></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Refered at:</td>
                                        <td style="width:25%;"><input type="text" class="myinput" style="height:70px; width: 230px;overflow-wrap: break-word;flex-wrap: wrap;word-wrap: break-word;"  id="refAt2" name="refAt2"  /></td>
                                        <td style="width:25%">Reason for Referral:</td>
                                        <td style="width:25%"><input style="height:70px; width: 230px;" type="text" id="reason2" name="reason2" readonly="readonly" class="myinput"/></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Contact Person:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="contact2" name="contact2" readonly="readonly" class="myinput" ></td>
                                        <td style="width:25%">Refered by: </td>
                                        <td style="width:25%"><input  style="width: 230px;" type="text" id="refby" name="refby" value="{{Auth::user()->id}}" hidden="hidden"><input  style="width: 230px;" type="text" id="refby22" name="refby22" readonly="readonly" class="myinput"></td>
                                        </tr>
                                        
                                        <tr>
                                        <td height="70px" colspan="4"><label> Recommendation/Attachments: </label> &emsp;<input style="height:70px; width: 670px;" type="text" id="ref_recom2" name="ref_recom2" readonly="readonly" class="myinput" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Refered back on(date)</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="refDateback2" name="refDateback2" readonly="readonly" class="myinput" ></td>
                                        <td style="width:25%">Refered back by:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="refbyback2" name="refbyback2" readonly="readonly" class="myinput" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Accepted by:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="accepted_by2" name="accepted_by2" readonly="readonly" class="myinput" ></td>
                                        <td style="width:25%">Referal slip return on</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="returnDate2" name="returnDate2" readonly="readonly" class="myinput" ></td>
                                        </tr>
                                        
                                        
                                      </table>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">
                                  <input type="hidden" id="user_accepted" name="user_accepted" value="{{Auth::user()->id}}">


                              </div>
                  </div>
          </div>
  </div>

  
    <div class="modal fade" id="linkEditor" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content"  style="width:980px;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Add Intervention the Patient Attended</h4>
                        </div>
                        <div class="modal-body">
                            <form id="linkeditor_Data" name="linkeditor_Data" class="form-horizontal" novalidate="">

                                @foreach($intv as $interven)
                                  <div>
                                    <input type="hidden" name="rec_id_{{$interven->id}}" id="rec_id_{{$interven->id}}" value="">
                                    <div class="checkboxs" id="checkboxes_{{$interven->id}}">
                                      <label><input type="checkbox" class="checkitems" id="checkitem[]" name="checkitem[]" style="zoom:1.5;font-size: 28px;"  value="{{$interven->id}}">{{$interven->interven_name}}</label>
                                    </div>

                                  @foreach($childIntervens->groupby('parent') as  $name => $member)

                                    @if($name  == $interven->id)

                                <div class="form-label-group select1" id="select_{{$interven->id}}" name="select_{{$interven->id}}"  style="display: none;">

                                  <select class="form-control col-md-6" id="childInterven_{{$interven->id}}"  name="childInterven_{{$interven->id}}" style=" margin-bottom: 10px">
                                    @foreach($member as $item)
                                      <option value="{{ $item['id']}}">{{  $item['interven_name'] }}</option>
                                          @endforeach
                                    </select>
                                  </div>
                                    @endif

                                  @endforeach
                                    <div class="form-label-group textboxes" id="textboxes_{{$interven->id}}" style="display: none;">
                                        <input style="margin-left:0px" type="text" class="form-control" placeholder="Remarks" name="remarks_{{$interven->id}}" id="remarks_{{$interven->id}}">
                                     </div>
                                   </br>
                                  </div>
                                @endforeach
                                  
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  id="btn-attended" name ="btn-attended" value="add">Save changes
                            </button>
                            <input type="hidden" id="evts_id" name="evts_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">


                        </div>
                    </div>
                </div>
            </div>

  <div class="modal fade" id="inactiveEditorModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  >
                         @if($pats->inactive != 1)
                              <div class="modal-header">
                                  <h4 class="modal-title" id="inactiveEditorModalLabel">
                             Inactive
                             </h4>
                              </div>
                              <div class="modal-body">
                                   <form id="inactivemodalFormData" name="inactivemodalFormData" class="form-horizontal" novalidate="">

                                          <p>You are about to inactive the patient! Inactivating the patient means the patient will no longer be associated in any types of events in the Rehabilation Center.</p>

                                           <h6>Remarks</h6>
                                           <textarea  type="text" id="note" class="form-control" placeholder="Note" name="note"></textarea>
                                    
                                    </form>
                              </div>

                              @else
                                 <div class="modal-header">
                                  <h4 class="modal-title" id="activeEditorModalLabel">Activate</h4>
                              </div>
                              <div class="modal-body">
                                   <form id="activemodalFormData" name="activemodalFormData" class="form-horizontal" novalidate="">

                                          <p>You are about to activate patient {{$pats->lname}}, {{$pats->fname}}! Click active button to proceed.</p>

                                           <h6>Remarks</h6>
                                           <textarea  type="text" id="note" class="form-control" placeholder="Note" name="note" ></textarea>
                                    
                                    </form>
                              </div>
                             @endif
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn_activate" name ="btn_activate" value="{{$pats->inactive}}"">Procceed
                                  </button>
                                  <input type="hidden" id="patient-id" name="patient-id" value="{{$pats->id}}">

                              </div>
                  </div>
          </div>
  </div>

 <div class="modal fade" id="VisitlinkEditor" aria-hidden="true" >
                <div class="modal-dialog">
                    <div class="modal-content" >
                        <div class="modal-header">
                            <h4 class="modal-title" id="linkEditorModalLabel">Patient Visit</h4>
                        </div>
                        <div class="modal-body">
                            <form id="VisitmodalFormData" name="VisitmodalFormData" class="form-horizontal" novalidate="">

                                @foreach($intv as $interven)
                                  <div>
                                    <input type="hidden" name="rec_id_{{$interven->id}}" id="rec_id_{{$interven->id}}" value="">
                                    <div class="checkboxs" id="checkboxes_{{$interven->id}}">
                                      <label><input type="checkbox" class="checkitems" id="checkitem[]" name="checkitem[]" style="zoom:1.5;font-size: 28px;"  value="{{$interven->id}}">{{$interven->interven_name}}</label>
                                    </div>

                                  @foreach($childIntervens->groupby('parent') as  $name => $member)

                                    @if($name  == $interven->id)

                                <div class="form-label-group select1" id="select_{{$interven->id}}" name="select_{{$interven->id}}"  style="display: none;">

                                  <select class="form-control col-md-6" id="childInterven_{{$interven->id}}"  name="childInterven_{{$interven->id}}" style=" margin-bottom: 10px">
                                    @foreach($member as $item)
                                      <option value="{{ $item['id']}}">{{  $item['interven_name'] }}</option>
                                          @endforeach
                                    </select>
                                  </div>
                                    @endif

                                  @endforeach
                                    <div class="form-label-group textboxes" id="textboxes_{{$interven->id}}" style="display: none;">
                                        <input style="margin-left:0px" type="text" class="form-control" placeholder="Remarks" name="remarks_{{$interven->id}}" id="remarks_{{$interven->id}}">
                                     </div>
                                   </br>
                                  </div>
                                @endforeach
                                  
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary"  id="btn-attended" name ="btn-attended" value="add">Save changes
                            </button>
                            <input type="hidden" id="evts_id" name="evts_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">
                            <input type="hidden" id="patient_interven_id" name="patient_interven_id" value="">


                        </div>
                    </div>
                </div>
            </div>
