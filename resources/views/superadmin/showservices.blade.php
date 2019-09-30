@extends('main')
@section('content')

<style>

  th {
  text-align: inherit;
  background-color: #212529;
  color:white;
  }

</style>
 
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{URL::to('/profile')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Services</li>
        </ol> 

        <div style="background-color: white;border-radius: 5px">
        <div class="row" style="margin-left: 5px;margin-bottom: 0px">
          <div class="col-xl-8 col-sm-9 mb-10" style="height: 6rem;">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 0px">Services</p>
              </div>

                @include('flash::message')

            </div>
          </div>
          <div class="col-xl-4 col-sm-9 mb-10">
            <div class="mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <a style="color:white" href="{{URL::to('/create_service')}}"><button class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 0px">New Service</button></a>
                </div>
              </div>
            </div>
         </div>
         <div class="card-body" style="margin-left: 10px">
               <div class="row" style="margin-left: 10px;">
                       @foreach($services as $service)
                      <div class="col-xl-4 col-sm-9 mb-10" style="height: 14rem;margin-top: 30px">
                        <div class="card border-dark mb-3 text-black o-hidden h-100">
                          <div class="card-body">
                              <p style="font-size: 40px;margin-top: 7px">{{$service->name}}</p>
                            <div class="mr-5"></div>
                          </div>
                          <a style="color:black" class="card-footer text-white clearfix small z-1" href="{{URL::to('/viewservice', $service->id)}}">
                            <span style="color:black" class="float-left">View Details</span>
                            <span  style="color:black" class="float-right">
                              <i class="fas fa-angle-right"></i>
                            </span>
                          </a>
                        </div>
                    </div>
                    @endforeach
                  </div> 
          </div>
        </div>


@endsection