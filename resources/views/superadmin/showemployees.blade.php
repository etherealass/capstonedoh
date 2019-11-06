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
          <li class="breadcrumb-item active"><b>Employees</b></li>
        </ol> 

      <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 0px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>Employees</b></p> 
              </div>

                @include('flash::message')

            </div>
          </div>
           <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/newemployee')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Employee</button></a>
              </div>
          </div>
        </div>
        </div>
         <div class="card-body" style="margin-left: 0px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($emp as $employee)
                  <tr>
                    <td>{{$employee->fname}} {{$employee->mname}} {{$employee->lname}}</td>
                    <td>{{$employee->contact}}</td>
                    <td>{{$employee->email}}</td>
                    <td>{{$employee->emp_designation->name}}</td>
                    <td>{{$employee->emp_department->department_name}} Department</td>
                    <td><a class="btn btn-success" href="{{URL::to('/viewemployee/'.$employee->id)}}" style="margin-right: 3px">View</a><button class="btn btn-primary" style="margin-right: 5px" data-toggle="modal" data-target="#editemployeeModal" data-userid="{{$employee->id}}" data-fname="{{$employee->fname}}" data-lname="{{$employee->lname}}" data-mname="{{$employee->mname}}" data-email="{{$employee->email}}" data-contact="{{$employee->contact}}" data-designation="{{$employee->designation}}" data-department="{{$employee->department}}">Edit</button><button class="btn btn-danger" data-toggle="modal" data-target="#deleteemployeeModal" data-employee_id="{{$employee->id}}">Delete</button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

  <div class="modal fade" id="editemployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
  <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-body">
        <form action="{{URL::to('/update_employeenow')}}" method="post">
          {{csrf_field()}}
          <div class="modal-body">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" id="fname" class="form-control" placeholder="First name" required="required" autofocus="autofocus" name="fname" value="">
                  <label for="fname">First name</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-label-group">
                  <input type="text" id="lname" class="form-control" placeholder="Last name" required="required" name="lname" value="">
                  <label for="lname">Last name</label>
                </div>
              </div>
               <div class="col-md-4">
               <div class="form-label-group">
                  <input type="text" id="mname" class="form-control" placeholder="Middle name" required="required" autofocus="autofocus" name="mname" value="">
                  <label for="mname">Middle Name</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
              <input type="email" id="email" class="form-control" placeholder="Email address" required="required" name="email" value="">
              <label for="email">Email address</label>
                </div>
              </div>
              <div class="col-md-6">
                 <div class="form-label-group">
                  <input type="text" id="contact" class="form-control" placeholder="Contact No." required="required" name="contact" value="">
                  <label for="contact">Contact no.</label>
                  <input type="hidden" class="form-control" name="userid" id="userid" value="">
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
              </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="designation" class="form-control" placeholder="Designation" required="required" name="designation" value="">
                  <label for="contact">Designation</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                 <select class="form-control" id="department" placeholder="Department" required="required" name="department" value="">
                  <label for="department">Department</label>
                    @foreach($deps as $dep)
                    <option value="{{$dep->id}}">{{$dep->department_name}} Department</option>
                    @endforeach
                    <option value="0">None</option>
                </select>
                </div>
              </div>
    
            </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save Changes</button>  
          </div>
        </form>
      </div>
      </div>
    </div> 
  </div>
  </div>
  </div>


@endsection