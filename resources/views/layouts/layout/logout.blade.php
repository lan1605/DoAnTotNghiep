
<div class="nav-item dropdown dropdown-user-setting">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown" aria-expanded="false">
        <div class="d-flex align-items-center">
            <img src="{{Auth::user()->img_hocvien==null ? '../../assets/images/icons/user.svg' : '../../hocviens/'.Auth::user()->img_hocvien}}" alt="" class="rounded-circle border" width="30" height="30">
            <div class="ms-3">
                <small class="mb-0 dropdown-user-designation text-white">
                  Xin chào, 
                </small>
              <h6 class="mb-0 dropdown-user-name text-white">{{ Auth::user()->name }} </h6>
            </div>
         </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 10000">
      <li>
         <a class="dropdown-item" href="{{ route('user.profile')}}">
           <div class="d-flex align-items-center">
              <img src="{{Auth::user()->img_hocvien==null ? '../../assets/images/icons/user.svg' : '../../hocviens/'.Auth::user()->img_hocvien}}" alt="" class="rounded-circle" width="40" height="40">
              <div class="ms-3">
                <h6 class="mb-0 dropdown-user-name">{{ Auth::user()->name }}</h6>
                <small class="mb-0 dropdown-user-designation text-secondary">
                    {{'Học viên'}}
                </small>
              </div>
           </div>
         </a>
       </li>
       <li><hr class="dropdown-divider"></li>
       
        <li>
          <a class="dropdown-item" href="/qua-trinh-on-tap">
             <div class="d-flex align-items-center">
               <div class=""><i class="bi bi-speedometer"></i></div>
               <div class="ms-3"><span>Quá trình ôn tập</span></div>
             </div>
           </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <div class="d-flex align-items-center">
              <div class=""><i class="bi bi-lock-fill"></i></div>
              <div class="ms-3"><span>{{ __('Đăng xuất') }}</span></div>
            </div>
          </a>
       <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
           @csrf
       </form>
        </li>
    </ul>
  </div>