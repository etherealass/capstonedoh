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
          <li class="breadcrumb-item active"><b>Gender</b></li>
        </ol> 

        <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px"><b>Gender</b></p> 
              </div>

                @include('flash::message')

            </div>
        </div>  
        <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                 <a href="{{URL::to('/add_a_gender')}}" style="color:white"><button class="btn btn-dark btn-block"  style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Gender</button></a>
              </div>
          </div>
        </div>
      </div> 
         <div class="card-body" style="margin-left: 10px">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                <thead>
                  <tr>
                    <th>Gender</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 @foreach($gender as $gend)
                 <tr>
                    <td>{{$gend->name}}</td>
                    @if($gend->flag != 'deleted')
                    <td><button class="btn btn-primary" style="margin-right: 20px" data-toggle="modal" data-target="#updateGender" data-gendid="{{$gend->id}}" data-gendname="{{$gend->name}}">Update</button><button class="btn btn-danger" data-toggle="modal" data-target="#deleteGender" data-gendid="{{$gend->id}}">Delete</button></td>
                    @else
                    <td><button class="btn btn-success" data-toggle="modal" data-target="#activateGender" data-gendid="{{$gend->id}}">Activate</button></td>
                    @endif
                 </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>

  <div class="modal fade" id="updateGender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Gender</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/update_gender')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="gendid" name="gendid" class="form-control" value="">
          <input type="text" id="gendname" name="gendname" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Edit</button>  
          </div>
        </form>
      </div>
    </div>
</div>

  <div class="modal fade" id="deleteGender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/delete_gender')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="gendid" name="gendid" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>  
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="activateGender" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{URL::to('/activate_gender')}}" method="post">
          {{csrf_field()}} 
          <div class="modal-body">
          <input type="hidden" id="gendid" name="gendid" class="form-control" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Activate</button>  
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection