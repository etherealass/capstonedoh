<nav class="navbar navbar-expand navbar-dark bg-dark sticky-top">

   <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button> 
      <a class="navbar-brand mr-1" href="{{URL::to('/profile')}}">
          <img style="height:60px;margin-top: 5px;margin-right: 0px;" src="{{asset('images/logo3.png')}}">
          <a class="navbar-brand mr-1" href="{{URL::to('/profile')}}"><h5><span><b>Treatment and Rehabilitation Center for Females - Cebu</b></span></h5></a>
        </a>  
    
    <!-- Navbar Search 
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Navbar -->
     <?php $count = 0;
           $countz = 0; ?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MySecondNotification')
                  <?php $count++; ?>
                  @elseif($user->type == 'App\Notifications\MyNotifications')
                  <?php $countz++; ?>
                  @endif
                @endforeach
              @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MySecondNotification')
                  @if(Auth::user()->user_department->department_name == $user->data['department'])
                  <?php $count++; ?>
                  @endif
                  @endif
                @endforeach
            @endif

      <?php $counts = 0;?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MyThirdNotifications')
                  <?php $counts++; ?>
                  @endif
                @endforeach
              @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                @foreach($users->unreadNotifications as $user)
                @if($user->type == 'App\Notifications\MyThirdNotifications')
                @if(Auth::user()->user_department->department_name == $user->data['to_department'])
                  <?php $counts++; ?>
                  @endif
                @endif
                @endforeach
            @endif

      <?php $countx = 0;?>
             @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
                @foreach($users->unreadNotifications as $user)
                  @if($user->type == 'App\Notifications\MyFourthNotifications')
                  <?php $countx++; ?> 
                  @endif
                @endforeach
            @endif  

    <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <p style="color:white;margin-top: 12px;font-size: 15px;"><b>Welcome {{Auth::user()->fname}} ({{Auth::user()->user_role()->first()->name}})</b></p>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #343a40">
          <i class="fas fa-bell fa-fw" style="font-size: 30px;margin-top: 0px"></i>
          <span class="badge badge-danger" style="font-size: 10px">{{$count + $countz}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px" aria-labelledby="alertsDropdown">
          <div>
              <div class="card-header">Notifications </div>
              <div class="card-body scrollAble" style="margin-left: 0"> 
              @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin') 
                @foreach($users->unreadNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @elseif($user->type == 'App\Notifications\MyNotifications')
                   <div style="border:thin gray;background-color: lightgray">
                    <p style="margin-top: 5px;margin-left: 20px"><a href="{{URL::to('/viewuserx/'.$user->data['user_id'].'/'.$user->id)}}" style="color:black">A user has been added as {{$user->data['role']}} in {{$user->data['department']}} Department</a></p>
                    <?php date_default_timezone_set('Asia/Singapore'); ?>
                    <p style="margin-left: 170px">{{$user->created_at->diffForHumans()}}</p>
                    <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                    </div>
                  @endif
                @endforeach
                @foreach($users->readNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p> <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @elseif($user->type == 'App\Notifications\MyNotifications')
                   <div style="border:thin gray">
                    <p style="margin-top: 5px;margin-left: 20px"><a href="{{URL::to('/viewuser/'.$user->data['user_id'])}}" style="color:black">A user has been added as {{$user->data['role']}} in {{$user->data['department']}} Department</a></p>
                    <?php date_default_timezone_set('Asia/Singapore'); ?>
                    <p style="margin-left: 170px">{{$user->created_at->diffForHumans()}}</p>
                    <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                    </div>
                  @endif
                @endforeach
                @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                  @foreach($users->unreadNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                      @if(Auth::user()->user_department->department_name == $user->data['department'])
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                    @endif
                  @endif
                @endforeach
                @foreach($users->readNotifications as $user)
                    @if($user->type == 'App\Notifications\MySecondNotification')
                      @if(Auth::user()->user_department->department_name == $user->data['department'])
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}" style="color:black">A patient has been added to {{$user->data['department']}} Department</a></p><?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 170px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                    @endif
                  @endif
                @endforeach
              @endif
              </div>
            </div>
        </div>
      </li>
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-building fa-fw" style="font-size: 30px;margin-top: 0px"></i>
          <span class="badge badge-danger" style="font-size: 10px">{{$counts}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px" aria-labelledby="alertsDropdown">
          <div>
            <div class="card-header" style="height: 50px">For Transfer Approval </div>
              <div class="card-body scrollAble" style="margin-left: 0;height: 170px">
              @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin') 
                @foreach($users->unreadNotifications as $user)
                  @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                      @if($trans->status != 'transfered')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 90px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 100px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @else
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @endif
                    @endif
                  @endforeach
                @endforeach
                @foreach($users->readNotifications as $user)
                 @foreach($transfer as $trans)
                  @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                   @if($trans->status != 'transfered')
               <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 90px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 100px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @else
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @endif
                  @endif 
                 @endforeach
                @endforeach
                @elseif(Auth::user()->user_role()->first()->name == 'Social Worker')
                  @foreach($users->unreadNotifications as $user)
                   @foreach($transfer as $trans)
                    @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                    @if($trans->status != 'transfered')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 0px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @else
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->updated_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @endif
                  @endif
                 @endforeach
                @endforeach
               @foreach($users->readNotifications as $user)
                 @foreach($transfer as $trans)
                  @if($user->type == 'App\Notifications\MyThirdNotifications' && $trans->transfer_id == $user->data['transfer_id'])
                   @if($trans->status != 'transfered')
               <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested to transfer from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 90px"><a href="{{URL::to('/viewpatients/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['transfer_id'])}}"><button class="btn btn-primary" style="margin-left: 100px">View</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @else
                <div style="border:thin black">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has been transfered from {{$user->data['from_department']}} Department to {{$user->data['to_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatient/'.$user->data['patient_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                   @endif
                  @endif 
                 @endforeach
                @endforeach
              @endif
              </div>
            </div>
        </div>
      </li>
      @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin')
       <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i style="font-size: 30px;" class="fa fa-graduation-cap"></i>
          <span class="badge badge-danger" style="font-size: 10px">{{$countx}}</span>
        </a>
        <div  class="dropdown-menu dropdown-menu-right" style="width: 500px;border:solid gray 1px"  aria-labelledby="userDropdown">
          <div>
          <div class="card-header" style="height: 50px">For Graduation Approval</div>
              <div class="card-body scrollAble" style="margin-left: 0;height: 170px">
              @if(Auth::user()->user_role()->first()->name == 'Superadmin' || Auth::user()->user_role()->first()->name == 'Admin') 
                @foreach($users->unreadNotifications as $user)
                  @foreach($graduate as $grad)
                    @if($user->type == 'App\Notifications\MyFourthNotifications' && $grad->graduate_id == $user->data['graduate_id'])
                      @if($grad->status != 'approved')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 20px">A patient has requested for graduation from {{$user->data['in_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 185px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 155px"><a href="{{URL::to('/viewpatientx/'.$user->data['patient_id']. '/'.$user->id.'/'.$user->data['graduate_id'])}}"><button class="btn btn-primary" style="margin-left: 30px">Review</button></a></p>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @elseif($grad->status == 'approved')
                <div style="border:thin black;background-color: lightgray">
                <p style="margin-top: 5px;font-size: 16px;margin-left: 50px">A patient has graduated from {{$user->data['in_department']}} Department</p>
                <?php date_default_timezone_set('Asia/Singapore'); ?>
                <p style="margin-left: 180px;font-size: 12px">{{$user->created_at->diffForHumans()}}</p>
                <p style="margin-left: 150px"><a href="{{URL::to('/viewpatientz/'.$user->data['patient_id'].'/'.$user->id)}}"><button class="btn btn-primary" style="margin-left: 30px">View</button></a>
                <div style="border:solid 1px rgba(0, 0, 0, 0.125)"></div>
                </div>
                      @endif
                    @endif
                  @endforeach
                @endforeach
              @endif
              
              </div>
        </div>
      </div>
      </li>
      @endif
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i style="font-size: 30px;" class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{URL::to('/show_my_logs/'.Auth::user()->id)}}">Activity Log</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#viewProfile">View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changepassword">Change Password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
    </ul>

  </nav>