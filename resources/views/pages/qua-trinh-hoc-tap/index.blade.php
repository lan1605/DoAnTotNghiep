@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        <div style="background-color: #f7f8fa">
            <div class="container">
                <div class="row g-3 ">
                    <ul class="nav nav-pills mb-3 d-flex align-items-center justify-content-center text-center " role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="pill" href="#lichsuhoc" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Lịch sử học tập</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-profile" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Bài học đã lưu</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="pill" href="#primary-pills-contact" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-microphone font-18 me-1'></i>
                                    </div>
                                    <div class="tab-title">Contact</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                   
                </div>
            </div>
        </div>
        <div style="background-color: white">
            <div class="container mt-2">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="lichsuhoc" role="tabpanel">
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
                                <div class=" col-lg-6 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                                    <div class="ms-auto position-relative">
                                        <div class="position-absolute top-50 translate-middle-y search-icon px-3"><i class="bi bi-search"></i></div>
                                        <input class="form-control ps-5" type="text" placeholder="tìm kiếm bài học..."name="key_find" value="{{Request()->key_find}}">
                                    </div>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                                </div>
                            </form>
                            <div class="table-responsive mt-5">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên bài học</th>
                                        <th>Chủ đề</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Tiến trình</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $dem = 0;
                                        @endphp
                                        @foreach ($baihoc as $item_bh)
                                            @php
                                                $dem = $dem +1;
                                            @endphp
                                            @foreach ($lichsu as $item_ls)
                                                @if ($item_ls->id_baihoc === $item_bh->id_baihoc)
                                                    <tr>
                                                        <td><span>{{$dem}}</span></td>
                                                        <td><span>
                                                            <a href="/baihoc/{{$item_bh->slug}}" target="_blank" rel="noopener noreferrer">{{$item_bh->ten_baihoc}}</a>    
                                                        </span></td>
                                                        <td><span>
                                                            @php
                                                                $chude = App\Models\ChuDe::find($item_bh->id_chude);
                                                                echo $chude->ten_chude;
                                                            @endphp
                                                        </span></td>
                                                        <td>
                                                            @php
                                                                $from_time = strtotime("$item_ls->created_at"); 
                                                                $to_time = strtotime("$item_ls->updated_at"); 
                                                                $diff_minutes = round(abs($to_time - $from_time) / 60,2);
                                                            @endphp
                                                            @if ($diff_minutes > 10)
                                                                <span class="badge bg-light-success text-success w-100">Đã học xong </span>
                                                                
                                                            @else
                                                                    <span class="badge bg-light-warning text-warning w-100">Đang học </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{$item_ls->created_at}}</span>
                                                        </td>
                                                        <td>
                                                            
                                                                @if ($diff_minutes > 10)
                                                                    <div class="progress" style="height: 5px">
                                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                                                    </div>
                                                                    <span>100%</span>
                                                                @else
                                                                    <div class="progress" style="height: 5px">
                                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: {{round(abs($diff_minutes) / 10,2)}}%"></div>
                                                                    </div>
                                                                @endif
                                                            
                                                        </td>
                                                    </tr>
                                                
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="tab-pane fade" id="primary-pills-profile" role="tabpanel">
                        <form action="" method="get" class="d-sm-flex mb-3 justify-content-center">
                            <div class="col-lg-4 col-12 col-md-12 mb-2 mb-sm-0 ms-2">
                                <?php
                                        $role = App\Models\ChuDe::all();    
                                    ?>
                                    <select name="find_cate2" id="" class="form-select">
                                        <option value="0">Tất cả</option>
                                        @if (isset($role))
                                        @foreach ($role as $item)
                                            <option value="<?php echo $item->id_chude?>" {{request()->find_cate2==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
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
                        </form>
                        <div class="table-responsive mt-5">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên bài học</th>
                                    <th>Chủ đề</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian bắt đầu</th>
                                    <th>Tiến trình</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $dem = 0;
                                    @endphp
                                    @foreach ($baihoc as $item_bh)
                                        @php
                                            $dem = $dem +1;
                                        @endphp
                                        @foreach ($lichsu as $item_ls)
                                            @if ($item_ls->id_baihoc === $item_bh->id_baihoc)
                                                <tr>
                                                    <td><span>{{$dem}}</span></td>
                                                    <td><span>{{$item_bh->ten_baihoc}}</span></td>
                                                    <td><span>
                                                        @php
                                                            $chude = App\Models\ChuDe::find($item_bh->id_chude);
                                                            echo $chude->ten_chude;
                                                        @endphp
                                                    </span></td>
                                                    <td>
                                                        @php
                                                            $from_time = strtotime("$item_ls->created_at"); 
                                                            $to_time = strtotime("$item_ls->updated_at"); 
                                                            $diff_minutes = round(abs($to_time - $from_time) / 60,2);
                                                        @endphp
                                                        @if ($diff_minutes > 10)
                                                            <span class="badge bg-light-success text-success w-100">Đã học xong <span>{{$diff_minutes}}</span></span>
                                                            
                                                        @else
                                                                <span class="badge bg-light-warning text-warning w-100">Đang học <span>{{$diff_minutes}}</span></span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span>{{$item_ls->created_at}}</span>
                                                    </td>
                                                    <td>
                                                        
                                                            @if ($diff_minutes > 10)
                                                                <div class="progress" style="height: 5px">
                                                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                                                                </div>
                                                                
                                                            @else
                                                                <div class="progress" style="height: 5px">
                                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{round(abs($diff_minutes) / 10,2)}}%"></div>
                                                                </div>
                                                            @endif
                                                        
                                                    </td>
                                                </tr>
                                            
                                            @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="primary-pills-contact" role="tabpanel">
                        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
                    </div>
                </div>
                
            </div>
            
        </div>

    </main>
@endsection