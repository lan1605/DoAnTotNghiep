<header class="top-header">        
    <nav class="navbar navbar-expand gap-3 align-items-center">
      <div class="mobile-toggle-icon fs-3">
          <i class="bi bi-list"></i>
      </div>
      <div class="d-none d-sm-block">
        <h4 class="text-primary">
          Hệ thống quản lý ứng dụng hỗ trợ học tập Tin học đại cương A
        </h4>
      </div>
        <div class="top-navbar-right ms-auto">
          <ul class="navbar-nav align-items-center">

          {{-- Cài đặt người dùng --}}
          <li class="nav-item dropdown dropdown-user-setting">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
              <div class="user-setting d-flex align-items-center">
                <img src="../../assets_admin/images/avatars/avatar-1.png" class="user-img" alt="">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                 <a class="dropdown-item" href="#">
                   <div class="d-flex align-items-center">
                      <img src="assets_admin/images/avatars/avatar-1.png" alt="" class="rounded-circle" width="54" height="54">
                      <div class="ms-3">
                        <h6 class="mb-0 dropdown-user-name">{{ Auth::user()->name }}</h6>
                        <small class="mb-0 dropdown-user-designation text-secondary">
                          @if (Auth::user()->role_id==1)
                              {{  __('Admin')}}
                          @else
                          {{  __('Giảng viên')}}
                          @endif
                        </small>
                      </div>
                   </div>
                 </a>
               </li>
               <li><hr class="dropdown-divider"></li>
               <li>
                  <a class="dropdown-item" href="{{ route('admin.profile')}}">
                     <div class="d-flex align-items-center">
                       <div class=""><i class="bi bi-person-fill"></i></div>
                       <div class="ms-3"><span>Profile</span></div>
                     </div>
                   </a>
                </li>
                <li>
                  <a class="dropdown-item" href="index2.html">
                     <div class="d-flex align-items-center">
                       <div class=""><i class="bi bi-speedometer"></i></div>
                       <div class="ms-3"><span>Dashboard</span></div>
                     </div>
                   </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <div class="d-flex align-items-center">
                      <div class=""><i class="bi bi-lock-fill"></i></div>
                      <div class="ms-3"><span>{{ __('Logout') }}</span></div>
                    </div>
                  </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                   @csrf
               </form>
                </li>
            </ul>
          </li>
          </ul>
          </div>
    </nav>
  </header>