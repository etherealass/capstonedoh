@extends('main')
@section('style')

<style> 
 /*    tbody{
       height:200px;display:block;overflow:scroll

     }*/

     body {
  background: #000;
  color: #fff;
}

.bootstrap-select.btn-group {width: auto !important;}

.bootstrap-select.btn-group .dropdown-toggle .filter-option { white-space: normal; }
   </style>

@endsection
@section('content')


 <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Create Event</li>
        </ol>

        <!-- Icon Cards-->
  <div class="container" style="margin-top: 30px">
        <p style="font-size:50px;margin-bottom: 20px">Create Event</p>
        <form action="{{URL::to('/add_event')}}" method="post">
          {{csrf_field()}}
            <fieldset style="margin-bottom: 30px">
            <legend style="color:white;text-indent: 20px;width:1100px;margin-bottom: 40px" class="bg bg-dark">Event Details</legend>
                <div class="form-group" style="margin-left:20px">
                    <div class="form-row">
                       <div class="col-md-12">
                          <div class="form-label-group">
                             <h6>Title*</h6>
                              <input type="text" id="title" class="form-control" placeholder="Title" required="required" autofocus="autofocus" name="title" value="{!! old('title') !!}">
                          </div>
                       </div>
                    </div>
                </div>
                <div class="form-group" style="margin-left:20px">
                    <div class='form-row'>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-11">
                                  <div class="form-label-group">
                                    <h6>Venue*</h6>
                                      <input type="text" id="venue" class="form-control" placeholder="Venue" name="venue">
                                  </div>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-6">
                                <div class="form-label-group">
                                    <h6>Start Date*</h6>
                                    <input type="date" id="start_date" class="form-control" placeholder="Start Date" name="start_date" value='{{$date}}'>
                                </div>
                              </div>
                              <div class="col-md-5">
                                <div class="form-label-group">
                                  <h6>Start Time*</h6>
                                  <input type="time" id="start_time" class="form-control" placeholder="Start Time" name="start_time" value="12:00">
                                </div>
                              </div>
                            </div>
                          </div>
                           <div class="form-group">
                              <div class="form-row">
                                <div class="col-md-6">
                                <div class="form-label-group">
                                    <h6>End Date*</h6>
                                    <input type="date" id="end_date" class="form-control" placeholder="End Date" name="end_date" value='{{$date}}'>
                                </div>
                              </div>
                                <div class="col-md-5">
                                  <div class="form-label-group">
                                    <h6>End Time*</h6>
                                    <input type="time" id="end_time" class="form-control" placeholder="End Time" name="end_time" value="12:00">
                                  </div>
                                </div>
                                
                             </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-11">
                                  <div class="form-label-group">
                                    <h6>Assignee</h6>
                                      <select id="nameid[]" class="selectpicker show-menu-arrow form-control" width="300" style="font-size: 18px; width: 300px;overflow: hidden;" name="nameid[]" multiple="multiple">
                                        @foreach($assignee->groupby('role') as $assign => $user)

                                        @foreach($roles as $role)
                                        @if($assign == $role->id)
                                            <optgroup label="{{$role->name}}">
                                          @foreach($user as $assgnee)
                                            <option value="{{$assgnee['id']}}">{{$assgnee['fname']}} {{$assgnee['lname']}}</option>
                                          @endforeach
                                        </optgroup>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </select>
                                  </div>
                              </div>
                            </div>
                              <div class="form-row">

                              <div class="col-md-11">
                                  <div class="form-label-group" style="margin-top: 25px">
                                    <h6>Department</h6>
                                    <select id="department" class="form-control" style="font-size: 18px;" name="department">
                                        @foreach($deps as $department)
                                        
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>

                <div class="form-group">
                  <div class='form-row'>
                      <div class="col-md-12">
                        <div class="card" >
                          <div class="card-header"><h6>List of Patient To Attend</h6></div>
                            <div class="card-body">
                              <div class="container" style="margin:45px auto">
                                  <div class="row">
                                      <div class="col-md-8 col-md-offset-3" >
                                        <table class="table table-hover table-striped table-bordered">
                                          <thead>
                                            <tr>
                                              <th style="text-align:center;width:45px"><input type="checkbox" id="checkall"/></th>
                                              <th>Name</th>
                                              <th>Department</th>
                                              <th>Contact Number</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($patients as $patients)
                                          <tr>
                                            <td class="text-center" height="50"><input type="checkbox" class="checkitem" name="checkitem[]" value='{{$patients->id}}'/>&nbsp;</td>
                                             <td height="50"><a> {{ $patients->lname }}, {{ $patients->fname }}</a></td>
                                             <td height="50"><a> {{ $patients->departments->department_name}}</a></td>
                                              <td height="50"><a> {{ $patients->contact}}</a></td>
                                             </tr>
                                          @endforeach

                                          </tbody>
                                      </table>
                                    </div> 
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

      </div>    

        </fieldset>

          <div class="col-md-12">
             <input style="width:400px;float:right;margin-top: 10px" class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
           </div><br>
           <br>
           <br>
           <br>
         

           </form>
         </div>
      
@endsection

@section('script')

  <script type="text/javascript">

       $(document).ready(function () {

        

        $(".picker").selectpicker({
      style: 'btn-info',
      size: 4
  });
        $('#checkall').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            console.log('checked');
            $(".checkitem").prop('checked', true);  
         } else {  
            $(".checkitem").prop('checked',false);  
         }  
        });
      })

  </script>  

@endsection


