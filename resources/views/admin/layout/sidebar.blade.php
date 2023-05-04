@if (Auth::user()->role_id==1)
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="../../assets_admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Snacked</h4>
    </div>
    <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="/dashboard" >
        <div ><i class="bi bi-house-fill"></i>
        </div>
        <div class="menu-title">Trang chủ</div>
      </a>
      
    </li>
    <li>
      <a href="/dashboard/hocvien">
        <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
        </div>
        <div class="menu-title">Học viên</div>
      </a>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i  class="lni lni-users"></i>
        </div>
        <div class="menu-title">Quản trị viên</div>
      </a>
      <ul>
        <li> <a href="/dashboard/quantrivien"><i class="bi bi-circle"></i>Danh sách quản trị viên</a>
        </li>
        <li> <a href="/dashboard/quantrivien/them"><i class="bi bi-circle"></i>Thêm quản trị viên mới</a>
        </li>
        <li> <a href="/dashboard/quyen"><i class="bi bi-circle"></i>Danh sách quyền quản trị</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="/dashboard/chude">
        <div class="parent-icon"><i class="bx bx-menu"></i>
        </div>
        <div class="menu-title">Chủ đề</div>
      </a>
      
    </li>
    <li>
      <a href="/dashboard/baihoc">
        <div class="parent-icon"><i class="bx bx-detail"></i>
        </div>
        <div class="menu-title">Bài học</div>
      </a>
     
      <li>
        <a href="/dashboard/baitap">
          <div class="parent-icon"><i class="bi bi-person-lines-fill"></i>
          </div>
          <div class="menu-title">Bài tập</div>
        </a>
       
      </li> 
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i  class="bx bx-list-ul"></i>
        </div>
        <div class="menu-title">Câu hỏi</div>
      </a>
      <ul>
        <li> <a href="/dashboard/cauhoi"><i class="bi bi-circle"></i>Danh sách câu hỏi</a>
        </li>
        {{-- <li> <a href="/dashboard/quantrivien/them"><i class="bi bi-circle"></i>Thêm quản trị viên mới</a>
        </li> --}}
        <li> <a href="/dashboard/loaicauhoi"><i class="bi bi-circle"></i>Danh sách loại câu hỏi</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="/dashboard/baidang">
        <div class="parent-icon"><i class="bx bx-news"></i>
        </div>
        <div class="menu-title">Bài đăng</div>
      </a>
     
    </li> 
    <li>
      <a href="/dashboard/baidang">
        <div class="parent-icon"><i class="bx bx-envelope-open"></i>
        </div>
        <div class="menu-title">Liên hệ</div>
      </a>
     
    </li> 
    <li>
      <a href="/dashboard/baidang">
        <div class="parent-icon"><i class="bx bx-spreadsheet"></i>
        </div>
        <div class="menu-title">Thông tin làm bài</div>
      </a>
     
    </li> 
  </ul>
  <!--end navigation-->
</aside>
@else
<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="../../assets_admin/images/logo-icon.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">Snacked</h4>
    </div>
    <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="/dashboard" >
        <div class="parent-icon"><i class="bi bi-house-fill"></i>
        </div>
        <div class="menu-title">Trang chủ</div>
      </a>
      
    </li>
    <li>
      <a href="/dashboard/chude">
        <div class="parent-icon"><i class="bx bx-menu"></i>
        </div>
        <div class="menu-title">Chủ đề</div>
      </a>
      
    </li>
    <li>
      <a href="/dashboard/baihoc">
        <div class="parent-icon">
          <i  class="bx bx-detail"></i>
        </div>
        <div class="menu-title">Bài học</div>
      </a>
     
    </li> 
    <li>
      <a href="/dashboard/baitap">
        <div class="parent-icon">
          <i  class="lni lni-users"></i>
        </div>
        <div class="menu-title">Bài tập</div>
      </a>
     
    </li> 
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i  class="bx bx-list-ul"></i>
        </div>
        <div class="menu-title">Câu hỏi</div>
      </a>
      <ul>
        <li> <a href="/dashboard/cauhoi"><i class="bi bi-circle"></i>Danh sách câu hỏi</a>
        </li>
        {{-- <li> <a href="/dashboard/quantrivien/them"><i class="bi bi-circle"></i>Thêm quản trị viên mới</a>
        </li> --}}
        <li> <a href="/dashboard/loaicauhoi"><i class="bi bi-circle"></i>Danh sách loại câu hỏi</a>
        </li>
      </ul>
    </li>

  </ul>
  <!--end navigation-->
</aside>
@endif