@extends('main')
@section('content')
 
        <!-- Breadcrumbs-->
    @if(Auth::user()->role == 2)

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">{{$rolex->name}}s</li>
        </ol> 

        <!-- Icon Cards-->
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-12 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px">{{$rolex->name}}s</p>
                
              </div>
              
            </div>
          </div>
        </div>

          @include('flash::message')


         <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($urole as $uroles)
                  @if($uroles->role > 2)
                  <tr>
                    <td>{{$uroles->fname}} {{$uroles->lname}}</td>
                    <td>{{$uroles->contact}}</td>
                    <td>{{$uroles->email}}</td>
                    <td style="text-align: center"><button class="btn btn-success" style="margin-right: 10px">View</button><button class="btn btn-primary" style="margin-right: 10px" data-toggle="modal" data-target="#editModal" data-userid="{{$uroles->id}}" data-fname="{{$uroles->fname}}" data-lname="{{$uroles->lname}}" data-uname="{{$uroles->username}}" data-email="{{$uroles->email}}" data-contact="{{$uroles->contact}}" data-department="{{$uroles->department}}" data-userid="{{$uroles->id}}">Edit</button><button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-userid="{{$uroles->id}}">Delete</button></td>
                  </tr>
                  @endif
                @endforeach
                </tbody>,
              </table>
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

  <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-body">
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
            <div class="form-row">
              <div class="col-md-6">
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
              @endif
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

  <div class="modal fade" id="sampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">hi</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/deletenow')}}" method="post">
          {{csrf_field()}}
          <div class="modal-body">
          <input type="hidden" id="user_id" name="user_id" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" datdata-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal" data-dismiss="modal">Delete</button>  
          </div>
        </form>
      </div>
    </div>
</div>


@endif
@endsection