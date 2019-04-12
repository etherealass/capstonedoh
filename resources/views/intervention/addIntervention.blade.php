@extends('main')
@section('content')

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{URL::to('/showIntervention')}}">Intervention</a>
          </li>
          <li class="breadcrumb-item active">Intervention Creation</li>
        </ol>

          @include('flash::message')
        <!-- Icon Cards-->
    <div class="container">
    <div class="card card-register mx-auto mt-4">
      <div class="card-header">Create Intervention</div>
      <div class="card-body">
      @if ($errors->any())
        @foreach ($errors->all() as $error)
         <div class="alert alert-danger">{{$error}}</div>
        @endforeach
      @endif
        <form action="{{URL::to('/create_intervention')}}" method="post">
          {{csrf_field()}}

             <div class="form-group">
                  <div class="form-label-group">
                    <h6>Name</h6>
                      <input type="text" id="name" class="form-control" placeholder="Name" required="required" name="interven_name">
                  </div>
                </div>
             <div class="form-group">
            <div class="form-label-group">
               <h6>Description</h6>
              <input style="height:100px;" type="textbox" id="descrpt" class="form-control" placeholder="Description" required="required" name="descrp">
            </div>
            <div class="form-label-group">
               <h6>Display To</h6>
              <select id="department[]" class="selectpicker form-control" style="font-size: 18px; width: 500px;height: 100px" name="department[]" multiple="multiple" required>
              @foreach($deps as $dep)
                  <option value="{{ $dep->id}}">{{ $dep['department_name'] }}</option>
              @endforeach
            </select>
            </div>
          </div>

           <input class="btn btn-primary btn-block" type="submit" name="submit" value="Create">
        </form>
      </div>
    </div> 
  </div>
  
@endsection