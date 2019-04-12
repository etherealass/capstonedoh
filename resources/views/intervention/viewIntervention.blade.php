@extends('main')
@section('content')

        <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Interventions</li>
        </ol>
       
                <!-- Icon Cards-->
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px">Intervention</p>
              </div>

                @include('flash::message')

            </div>
          </div>
          <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                   <a style="color:white" href="{{URL::to('/add_intervention')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">New Intervention</button></a>

                </div>
              </div>
            </div>
         </div>
        <!-- Icon Cards-->
        <div class="row" style="margin-left: 10px;">
           @foreach($inter as $inters)
          <div class="col-xl-4 col-sm-9 mb-10" style="height: 14rem;margin-top: 30px">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 40px;margin-top: 7px">{{$inters->interven_name}}</p>
                <div class="mr-5"></div>
              </div>
              <a style="color:black" class="card-footer text-white clearfix small z-1" href="{{URL::to('/viewIntervention', $inters->id)}}">
                <span style="color:black" class="float-left">View Details</span>
                <span  style="color:black" class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
        </div>
        @endforeach
      </div> 

@endsection