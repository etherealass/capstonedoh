<!DOCTYPE html>
<html lang="en">

@include('parts.head')

<body class="bg-dark">

  <div class="container row" style="margin-left:300px;margin-top:80px">
     <div class="col-xl-6 col-sm-9 mb-10" style="height: 17rem;">
            <div class="card border-dark mb-3 text-black o-hidden h-100">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 50px"><i class="fas fa-fw fa fa-question"></i> TBD</p>
                <div class="mr-5">TBD</div>
              </div>
              <a class="card-footer text-black clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
             <div class="card border-dark text-black o-hidden h-100" style="margin-top: 25px;">
              <div class="card-body">
                  <p style="font-size: 50px;margin-top: 50px"><i class="fas fa-fw fa fa-question"></i> TBD</p>
                <div class="mr-5">TBD</div>
              </div>
              <a class="card-footer text-black clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
      </div>
       <div class="card card-login">
      <img style="height:150px;width:150px;margin-top: 30px;margin-left: 120px;" src="{{asset('images/logo2.png')}}">
      <div class="card-header" style="font-size: 20px;text-align: center">CEBU TREATMENT AND REHABILITATION CENTER FOR FEMALES</div>
      <div class="card-body">
        @if ($error = $errors->first('password'))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
        @endif
        <form action="{{URL::to('/loginnow')}}" method="Post">
           {{csrf_field()}}
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="username" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="username">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="password" class="form-control" placeholder="Password" required="required" name="password">
              <label for="password">Password</label>
            </div>
          </div>
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="Login">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="{{URL::to('/register')}}">Register an Account</a>
        </div> 
      </div>
    </div>
  </div>

  @include('parts.scripts')

</body>

</html>
