@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        Danh sách bài tập đã làm
    </title>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        <div style="background-color: white">
            <div class="container mt-2">
                <div class="row g-3 d-flex align-items-center ">
                    <form action="" method="get" class="d-sm-flex mb-3 justify-content-center">
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
                        
                        <div class="mb-2 mb-sm-0 ms-2">
                            <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                        </div>
                    </form>
                    
                   
                </div>
                <div class="alert border-0 bg-light-secondary alert-dismissible fade show py-1">
                    <div class="d-flex align-items-center">
                    
                    <div class="ms-0">
                        <div class="text-success">
                            <p class=" text-black mt-1 ">
                                @if (!empty(request()->find_cate))
                                        
                                        <?php
                                            $cate = App\Models\ChuDe::find(request()->find_cate);
                                        ?>
                                        @if (count($thongtin)==0)
                                            {{'Chưa có thông tin, vui lòng kiểm tra lại'}}
                                        @else
                                        {{count($thongtin).' bài tập được tìm thấy theo chủ đề "'.$cate->ten_chude.'"'}}
                                        @endif
                                @else  
                                    {{count($thongtin).' bài tập được tìm thấy '}}
                                @endif
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
                
                @if (count($thongtin)==0)
                
            @else
            <div class="table-responsive mt-3">
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
                        @foreach ($thongtin as $item=>$value)
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
            @endif
            </div>
            
        </div>
    </main>
@endsection