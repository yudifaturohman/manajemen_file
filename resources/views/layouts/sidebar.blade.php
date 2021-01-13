<ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                @if(Auth::user()->foto == '')

                  <img src="{{asset('images/user/default.png')}}" alt="profile image">
                @else

                  <img src="{{asset('images/user/'. Auth::user()->foto)}}" alt="profile image">
                @endif
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->name}}</p>
                  <div>
                    <small class="designation text-muted" style="text-transform: uppercase;letter-spacing: 1px;">{{ Auth::user()->level }}</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ url('/') }}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          @if(Auth::user()->level == 'admin')
          <li class="nav-item ">
            <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Master Data</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('guru.index')}}">Data Guru</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('file.index') }}">Data File</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('manage_user.index') }}">
              <i class="menu-icon mdi mdi-sign-in"></i>
              <span class="menu-title">Management User</span>
            </a>
          </li>
          @endif
          @if(Auth::user()->level == 'guru')
          <li class="nav-item"> 
            <a class="nav-link" href="{{ route('file.index') }}">
              <i class="menu-icon mdi mdi-file"></i>
              <span class="menu-title">Semua File</span>
            </a>
          </li>
          @endif         
        </ul>