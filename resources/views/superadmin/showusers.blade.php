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
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
          </li>
          <li class="breadcrumb-item active"><b>{{$rolex->name}}s</b></li>
        </ol> 

        <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>{{$rolex->name}}s</b></p> 
              </div>

                @include('flash::message')

            </div>
          </div>
           <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/create_user/'.$rolex->id)}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New {{$rolex->name}}</button></a>
              </div>
          </div>
        </div>
        </div>
         <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($urole as $uroles)
                  <tr>
                    <td>{{$uroles->fname}} {{$uroles->lname}}</td>
                    <td>{{$uroles->contact}}</td>
                    <td>{{$uroles->email}}</td>
                    @if($uroles->department == '')
                    <td>--{{$uroles->user_roles->name}}--</td>
                    @else
                    <td>
                      @foreach($udepts as $udep)
                        @if($udep->user_id == $uroles->id)
                          {{$udep->departmentsc->department_name}}
                        @endif
                      @endforeach
                    </td>
                    @endif
                    <td style="text-align: center"><a class="btn btn-success" style="margin-right: 10px" href="{{URL::to('/viewuser/'.$uroles->id)}}">View</a><button class="btn btn-primary" style="margin-right: 10px" data-toggle="modal" data-target="#editModal" data-userid="{{$uroles->id}}" data-fname="{{$uroles->fname}}" data-lname="{{$uroles->lname}}" data-uname="{{$uroles->username}}" data-email="{{$uroles->email}}" data-contact="{{$uroles->contact}}" data-department="{{$uroles->department}}" data-designation="{{$uroles->designation}}" data-userid="{{$uroles->id}}" data-password="{{$uroles->password}}">Edit</button><button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-userid="{{$uroles->id}}">Delete</button></td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#changepass" data-dismiss="modal">Change Password</button>
  <div class="container">
  <!-- <div class="card card-register mx-auto mt-4">
      <div class="card-body">-->
        <form action="{{URL::to('/updatenow')}}" method="post">
          {{csrf_field()}}
          <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="fname" value="">
                  <label for="fname">First name</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" name="lname" value="">
                  <label for="lname">Last name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <div class="form-label-group">
                  <input type="text" id="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="username" value="">
                  <label for="username">Username</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="email" id="email" class="form-control" placeholder="Email address" required="required" name="email" value="">
              <label for="email">Email address</label>
            </div>
          </div>
          <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact" value="">
                  <label for="contact">Contact no.</label>
                  <input type="hidden" class="form-control" name="userid" id="userid" value="">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
              </div>
              </div>
              @if($rolex->id == 2)
              <input type="hidden" name="deparment" id="department" value="">
              @else
               <label for="department">Department</label>
              <div class="form-group">
                <div class="form-label-group">
                 <select class="form-control selectpicker depart" id="depart[]" placeholder="Department" required="required" name="depart[]" multiple="multiple">
                  @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                  @endforeach
                </select>
                </div>
              </div>
              @endif
              @if($rolex->name == 'Doctor')
              <div class="form-group">
            <div class="form-row">
               <div class="col-md-6">
                <label for="department">Designation</label>
                <div class="form-label-group">
                 <select class="form-control" id="designation" placeholder="Designation" required="required" name="designation">
                  <label for="designation">Designation/Position</label>
                   <option disabled selected hidden>Designation/Position</option>
                   <option value="">--NONE--</option>
                  @foreach($roles as $des)
                    @if($des->parent == $rolex->id)
                    <option value="{{$des->id}}">{{$des->name}}</option>
                    @endif
                  @endforeach

                    <option value="Others">Others</option>
                </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-label-group" id="design" style="display:none">
                  <input type="text" id="designat" class="form-control" placeholder="Designation" name="designat">
                  <label for="designat">Please specify designation</label>
                </div>
              </div>
            </div>
          </div>
              @ENDIF
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save Changes</button>  
          </div>
        </form>
     <!-- </div>
     </div>-->
      </div>
  </div>
  </div>
  </div>


@endsection

@section('script')
<script>
      

</script>
@endsection