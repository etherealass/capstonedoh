<ul class="sidebar navbar-nav" style="">
      <li class="nav-item active">
        <a class="nav-link" href="{{URL::to('/profile')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-users"></i>
          <span>Users</span>
        </a>
        @if(Auth::user()->role == 1)
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          @foreach($roles as $role)
            @if($role->id != 1)
          <a class="dropdown-item" href="{{ route('showUsers',$role->id) }}">{{$role->name}}s</a>
          @endif
          @endforeach
        </div>
        @elseif(Auth::user()->role == 2)
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          @foreach($roles as $role)
            @if($role->id > 2)
          <a class="dropdown-item" href="{{ route('showUsers',$role->id) }}">{{$role->name}}s</a>
          @endif
          @endforeach
        </div>
        @endif
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-building"></i>
          <span>Departments</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
         @foreach($deps as $dep)
          <a class="dropdown-item" href="{{ route('showDeps',$dep->id) }}">{{$dep->department_name}}</a>
         @endforeach
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-user"></i>
          <span>Patients</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Reports</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-list"></i>
          <span>Forms</span></a>
      </li>
    </ul>