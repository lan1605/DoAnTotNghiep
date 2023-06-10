@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->
    @include('layouts.notificationLogin')
    <div class="card">
        <div class="card-header py-3">
            <div class="card-body">
                <div class="row">
                    @include('layouts.notication')
                    {{-- HIỂN THỊ DANH SÁCH --}}
                        <div class="col-12 col-lg-12 d-flex">
                            <div class="card border shadow-none w-100">
                            <div class="card-body">
                            <form action="" method="get" class="d-sm-flex mb-3">
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <?php
                                        $role = App\Models\ChuDe::all();    
                                    ?>
                                    <select name="id_chude" id="chude" class="form-select">
                                        <option value="0">Tất cả chủ đề</option>
                                        @if (isset($role))
                                        @foreach ($role as $item)
                                            <option value="<?php echo $item->id_chude?>" {{request()->id_chude==$item->id_chude ? 'selected' : false}}><?php echo $item->ten_chude?></option>
                                        @endforeach
                                            
                                        @endif
                                    </select>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <select name="thongke" id="baihoc" class="form-select">
                                        <option value="0">Chưa có bài tập</option>
                                        @if (!isset(request()->thongke))
                                        
                                    @else
                                        <?php
                                            $baihoc = App\Models\BaiHoc::where('id_chude', request()->id_chude)->get();
                                        ?>
                                        @foreach ($baihoc as $item)
                                        <option value="<?php echo $item->id_baihoc?>" {{request()->thongke==$item->id_baihoc ? 'selected' : false}}><?php echo $item->ten_baihoc?></option>
                                        @endforeach
                                    @endif
                                    </select>
                                    <script>
                                        $(document).ready(function () {
                                            $('#chude').on('change', function () {
                                                var chudeID = this.value;
                                                $.ajax({
                                                    url: '{{ route('ajax.baitap') }}?id_chude='+chudeID,
                                                    type: 'get',
                                                    success: function (res) {

                                                        if (res!==""){
                                                            $('#baihoc').html('<option value="0">Chọn bài tập</option>');
                                                            $.each(res, function (key, value) {
                                                            $('#baihoc').append('<option value="' + value
                                                                .id_baihoc + '"{{request()->find_lession=='+value.id_baihoc+' ? "selected" : false}}>' + value.ten_baihoc + '</option>');
                                                        });
                                                        console.log(res);
                                                        }
                                                        else {
                                                            $('#baihoc').html('<option >Chưa có bài tập</option>');
                                                            console.log(res);
                                                        }
                                                        
                                                    }
                                                    
                                                });
                                            });
                                        });
                                    </script>
                                </div>
                                <div class="mb-2 mb-sm-0 ms-2">
                                    <button type="submit" class="btn btn-primary mb-3 mb-lg-0">Tìm kiếm</button>
                                </div>
                                
                            </form>
                            
                            
                                       
                            @if (!isset($data))
                                Không có thông tin hiển thị. Vui lòng chọn <strong>Tất cả chủ đề</strong> và chọn <strong>bài học</strong> mà bạn muốn xem thống kê
                            @else
                                @if ($data==null)
                                Không có thông tin hiển thị. Có thể bài tập bạn muốn xem thống kê chưa có học viên làm.
                                @else
                                <div class="card">
                                    <div class="card-body">
                                      <div id="chart"></div>
                                      <style>
                                        .apexcharts-menu-item.exportCSV{
                                            display: none
                                        }
                                      </style>
                                    </div>
                                  </div>
                                </div>
                                <script>
            
                                    $(function () {
                                    "use strict";
                                    var dataDiem = JSON.parse('{!! json_encode($diem) !!}');
                                    var soLan = JSON.parse('{!! json_encode($solan) !!}');
                                    // chart 1
                                    var options = {
                                        series: [{
                                            name: 'Số lần làm',
                                            data: soLan
                                        }],
                                        
                                        chart: {
                                            foreColor: '#9ba7b2',
                                            height: 360,
                                            type: 'line',
                                            zoom: {
                                                enabled: false
                                            },
                                            toolbar: {
                                                show: true
                                            },
                                            dropShadow: {
                                                enabled: true,
                                                top: 3,
                                                left: 14,
                                                blur: 4,
                                                opacity: 0.10,
                                            }
                                        },
                                        stroke: {
                                            width: 5,
                                            curve: 'smooth'
                                        },
                                        xaxis: {
                                            //type: 'datetime',
                                            categories: dataDiem ,
                                            title: {
                                                text: 'Điểm số',
                                                style: {
                                                    fontSize: "14px",
                                                fontFamily: "Roboto, sans-serif"
                                            }
                                            },
                                            style: {
                                                    fontSize: "14px",
                                                fontFamily: "Roboto, sans-serif"
                                            }
                                        },
                                        title: {
                                            text: 'Thống kê điểm của bài tập "{{$title}}"',
                                            align: 'center',
                                            style: {
                                                fontSize: "16px",
                                                color: '#666',
                                                fontFamily: "Roboto, sans-serif"
                                            }
                                        },
                                        fill: {
                                            type: 'gradient',
                                            gradient: {
                                                shade: 'light',
                                                gradientToColors: ['#3461ff'],
                                                shadeIntensity: 1,
                                                type: 'horizontal',
                                                opacityFrom: 1,
                                                opacityTo: 1,
                                                stops: [0, 100, 100, 100]
                                            },
                                        },
                                        markers: {
                                            size: 4,
                                            colors: ["#3461ff"],
                                            strokeColors: "#fff",
                                            strokeWidth: 2,
                                            hover: {
                                                size: 7,
                                            }
                                        },
                                        colors: ["#3461ff"],
                                        yaxis: {
                                            title: {
                                                text: 'Số lần làm',
                                                style: {
                                                    fontSize: "14px",
                                                fontFamily: "Roboto, sans-serif"
                                            }
                                            },
                                        
                                        }
                                        
                                    };
                                    var chart = new ApexCharts(document.querySelector("#chart"), options);
                                    chart.render();
                            });
                                </script>
                                @endif
                            @endif
                        </div>
                    {{-- end --}}
                </div>
            </div>
        </div>
    
    
        </div>
        </div>
</div>
</div>

</main>
@endsection
@section('javascript')
    
@endsection
