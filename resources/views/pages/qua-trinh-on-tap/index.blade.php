@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Danh sách bài học đã lưu
    </title>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        <div style="background-color: white">
            <div class="container mt-2">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="lichsuhoc" role="tabpanel">
                            {{-- <form action="" method="get" class="d-sm-flex mb-3 justify-content-center">
                                <div class="col-lg-4 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                                    <?php
                                            $role = App\Models\ChuDe::all();    
                                        ?>
                                        <select name="find_cate" id="" class="form-select">
                                            <option value="0">Tất cả</option>
                                            @if (isset($role))
                                            @foreach ($role as $item)
                                                <option value="<?php echo $item->id_chude?>" {{request()->find_cate==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                            @endforeach
                                            
                                            @endif
                                        </select>
                                </div>
                                <div class=" col-lg-6 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                        <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài học..."name="key_find" value="{{Request()->key_find}}">
                                    </div>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                                </div>
                            </form> --}}
                            <div class="table-responsive mt-5">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên bài tập</th>
                                        <th>Chủ đề</th>
                                        <th>Số lần làm bài</th>
                                        <th>Tùy chọn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $dem = 0;
                                        @endphp
                                        @foreach ($users as $item=>$value)
                                        @php
                                            $dem = $dem +1;
                                        @endphp
                                            <tr>
                                                <td>
                                                    <span>
                                                        {{$dem}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        @php
                                                            $baitap = App\Models\BaiTap::find($item);
                                                            // dd($baitap);
                                                        @endphp
                                                        {{$baitap->ten_baitap}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        @php
                                                            $baihoc = App\Models\BaiHoc::find($baitap->id_baihoc);
                                                            $chude = App\Models\ChuDe::find($baihoc->id_chude);
                                                            echo $chude->ten_chude;
                                                        @endphp
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        @php
                                                            $count = 0;
                                                            foreach($value as $user) {
                                                                $count++;
                                                            }
                                                        @endphp
                                                        {{$count}}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <a href="/qua-trinh-on-tap/{{$baitap->slug}}">Xem chi tiết </a>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        {{-- foreach($users as $timezone => $userList) {
                                            echo '<ul>';
                                                echo '<li>' . $timezone . '</li>';
                                                $baitap = BaiTap::find($timezone);
                                                $baihoc = BaiHoc::find($baitap->id_baihoc);
                                                $chude = ChuDe::find($baihoc->id_chude);
                                                echo $chude->ten_chude;
                                                echo '<ul>'; 
                                                $dem = 0;
                                                
                                                foreach($userList as $user) {
                                                    echo '<li>User Email: ' . $user->id_baitap . $user->tong_diem.$user->created_at. '</li>';
                                                    $dem = $dem +1;
                                                    
                                                }
                                                echo '</ul>';
                                                
                                                echo '</ul>';
                                                echo $dem;
                                            } --}}
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    
                </div>
                
            </div>
            
            
        </div>

    </main>
@endsection