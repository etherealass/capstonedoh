@extends('main')
@section('content')

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{URL::to('/profile')}}"><b>Dashboard</b></a>
      </li>
     <li class="breadcrumb-item">
        <a href="{{URL::to('/show_services')}}"><b>Services</b></a>
      </li>
      <li class="breadcrumb-item active"><b>Service Creation</b></li>
    </ol>

    <!-- Icon Cards-->
    <div class="container">
      <div class="card card-register mx-auto mt-4">
        <div class="card-header"><b>Create Service</b></div>
        <div class="card-body">
        @if ($errors->any())
          @foreach ($errors->all() as $error)
           <div class="alert alert-danger">{{$error}}</div>
          @endforeach
        @endif
          <form action="{{URL::to('/add_service')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-12">
                  <div class="form-label-group">
                    <input type="text" id="servicename" class="form-control" placeholder="Service Name" required="required" autofocus="autofocus" name="name">
                    <label for="servicename">Service Name</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input style="height:100px;" type="textbox" id="servicedesc" class="form-control" placeholder="Service Description" required="required" name="description">
                <label for="servicedesc">Description</label>
              </div>
            </div>
            <div class="form-group">

              <label>Display</label>
              <select id="display[]" class="selectpicker form-control" style="font-size: 18px; width: 500px;height: 100px" name="display[]" multiple="multiple">
              @foreach($roles as $role)
                  <option value="{{ $role->id}}">{{ $role['name'] }}</option>
              @endforeach
            </select>
            </div>

            <div class="form-group">
              <label>Notify</label>
              <select id="notify[]" class="selectpicker form-control" style="font-size: 18px; width: 500px;height: 100px" name="notify[]" multiple="multiple">
              @foreach($roles as $role)
               <option value="{{ $role->id}}">{{ $role['name'] }}</option>
              @endforeach
        
            </select>
            </div>

             <input class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
          </form>
        </div>
      </div> 
    </div>

@endsection
