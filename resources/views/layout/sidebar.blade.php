  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{asset('images/faces/face1.jpg')}}" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">

            <span class="font-weight-bold mb-2">
              @if (auth()->user()->role ==1)
              {{auth()->user()->username}}
              @endif
              @if (auth()->user()->role ==0)
              {{auth()->user()->username}}
              @endif

            </span>
            <span class="text-secondary text-small">
              @if (auth()->user()->role ==1)
              Mahasiswa
              @endif
              @if (auth()->user()->role ==0)
              Admin
              @endif
            </span>
          </div>


          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      {{--========================ADMIN========================--}}
      @if (auth()->user()->role == 0)
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Mahasiswa</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/mahasiswa">Data Mahasiswa</a></li>
            <li class="nav-item"> <a class="nav-link" href="/kompenadmin">Pengajuan Kompensasi</a></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/kegiatan">
          <span class="menu-title">Kegiatan Kompensasi</span>
          <i class="mdi mdi-file-document menu-icon"></i>
        </a>
      </li>
      @endif
      {{--========================END ADMIN========================--}}

      {{--========================Mahasiswa========================--}}
      @if (auth()->user()->role == 1)
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/kompenmahasiswa">
          <span class="menu-title">Pengajuan Kompensasi</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>

      @endif
      {{--========================END Mahasiswa========================--}}

    </ul>
  </nav>