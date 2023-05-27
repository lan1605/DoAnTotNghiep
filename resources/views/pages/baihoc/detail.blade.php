@extends('layouts.app')
@include('layouts.layout.menu')
@section('login-for-users')
    <div class="d-flex ms-3 gap-3">
        @include('layouts.layout.auth')
      </div>
@endsection
@section('title')
    <title>
        {{$chitiet->ten_baihoc}}
    </title>
@endsection
@section('content')
@include('layouts.layout.breadcrumb')
    <main>
        @if (session('success'))
            <script>
                Lobibox.notify('success', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-check-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('success')}}'
                });
            </script>
        @endif
        @if (session('error'))
            <script>
                Lobibox.notify('error', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-x-circle',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('error')}}'
                });
            </script>
        @endif
        @if (session('already'))
            <script>
                Lobibox.notify('warning', {
                    pauseDelayOnHover: true,
                    size: 'mini',
                    icon: 'bx bx-error',
                    continueDelayOnInactiveTab: false,
                    position: 'bottom right',
                    msg: '{{session('already')}}'
                });
            </script>
        @endif
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-8 ">
                        <div >
                            <div class="card-header py-2 " >
                                <h2 class="fw-500 text-primary">{{$chitiet->ten_baihoc}}</h2>
                                <p>Thời gian đọc: <span>
                                    @php
                                        Str::macro('readDuration', function(...$body) {
                                        $totalWords = str_word_count(implode(" ", $body));
                                        $minutesToRead = round($totalWords / 200);

                                        return (int)max(1, $minutesToRead);
                                    });

                                    $est = Str::readDuration($chitiet->noi_dung). ' phút';
                                    echo $est;
                                    @endphp </span></p>
                                <p class="py-0"><strong>
                                    <?php
                                        $chude = App\Models\ChuDe::find($chitiet->id_chude);
                                        echo $chude->ten_chude;    
                                    ?>
                                    </strong>
                                </p>
                                <div class="d-flex mt-2 justify-content-center gap-2">
                                    <?php
                                        $check = App\Models\LuuBaiHoc::where('id_baihoc', $chitiet->id_baihoc)->first();
                                    ?>
                                    @if (isset($check->id_baihoc))
                                        <a href="/baihoc/{{$chitiet->slug}}/huy" class="btn btn-danger px-5" id="huybaihoc"> <i class="bi bi-bookmark-check-fill"></i>Xóa khỏi danh sách</a>
                                        
                                    @else
                                        <a href="/baihoc/{{$chitiet->slug}}/luu" class="btn btn-danger px-5" id="luubaihoc"> <i class="bi bi-bookmark-check-fill"></i> Lưu bài học</a>
                                    @endif
                                    <?php
                                        $baitap = App\Models\BaiTap::where('id_baihoc', $chitiet->id_baihoc)->first();
                                    ?>
                                        @if (isset($baitap->id_baihoc))
                                            <a href="/baitap/{{$baitap->slug}}" class="btn btn-success px-5" id="lambaitap"> <i class="bx bx-credit-card-front"></i> Làm bài tập</a>
                                        @else
                                            
                                        @endif
                                        
                                </div>
                            </div>
                            @if ($chitiet->video==null)
                                
                            @else
                            <div class="card-body">
                                <video controls id="video-tag" width="100%" height="400">
                                    <source id="video-source" src="{{$chitiet->video}}">    
                                </video>
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="row g-2 mt-1">
                                    <div class="col-12" id="contents">
                                        {!! $chitiet->noi_dung !!}
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        @if ($prev)
                                        @php
                                            $baitruoc = App\Models\BaiHoc::find($prev);
                                        @endphp
                                            <h5>
                                                <div class="d-flex align-items-center">
                                                    <a href="/baihoc/{{$baitruoc->slug}}" title="{{$baitruoc->ten_baihoc}}">
                                                        <i class="bx bx-chevron-left-circle"></i>
                                                        {{$baitruoc->ten_baihoc}}
                                                    </a>
                                                </div>
                                            </h5>
                                        @endif
                                        @if ($next)
                                        @php
                                            $baitruoc = App\Models\BaiHoc::find($next);
                                        @endphp
                                            <h5>
                                                <div class="d-flex align-items-center">
                                                    <a href="/baihoc/{{$baitruoc->slug}}" title="{{$baitruoc->ten_baihoc}}">
                                                        {{$baitruoc->ten_baihoc}}
                                                        <i class="bx bx-chevron-right-circle"></i>
                                                    </a>                                                
                                                </div>
                                            </h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="sticky-top">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                       <h3>Nội dung bài học</h3>
                                    </div>
                                    <div id="toc">
                                        
                                        <script>
                                            var c = function() {
                                                        return({
                                                            log: function(msg) {
                                                            consoleDiv = document.getElementById('console');
                                                            para = document.createElement('p');
                                                            text = document.createTextNode(msg);
                                                            para.appendChild(text);
                                                            consoleDiv.appendChild(para);
                                                            }
                                                        });
                                                    }();
        
                                                    window.onload = function () {
                                                        var toc = "";
                                                        var level = 0;
                                                        var maxLevel = 4;
        
                                                        document.getElementById("contents").innerHTML =
                                                            document.getElementById("contents").innerHTML.replace(
                                                                /<h([\d])>([^<]+)<\/h([\d])>/gi,
                                                                function (str, openLevel, titleText, closeLevel) {
                                                                    if (openLevel != closeLevel) {
                                                                    c.log(openLevel)
                                                                        return str + ' - ' + openLevel;
                                                                    }
        
                                                                    if (openLevel > level) {
                                                                        toc += (new Array(openLevel - level + 0)).join("<ul style='list-style: none; padding-left: 1rem'>");
                                                                    } else if (openLevel < level) {
                                                                        toc += (new Array(level - openLevel + 0)).join("</ul>");
                                                                    }
        
                                                                    level = parseInt(openLevel);
        
                                                                    var anchor = titleText.replace(/ /g, "_");
                                                                    toc += "<li><a href=\"#" + anchor + "\">" + titleText
                                                                        + "</a></li>";
        
                                                                    return "<h" + openLevel + "><a name=\"" + anchor + "\">"
                                                                        + titleText + "</a></h" + closeLevel + ">";
                                                                }
                                                            );
        
                                                        if (level) {
                                                            toc += (new Array(level + 0)).join("</ul>");
                                                        }
        
                                                        document.getElementById("toc").innerHTML += toc;
                                                    };
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h3>
                                        <?php
                                            $chude = App\Models\ChuDe::find($chitiet->id_chude);
                                                        echo $chude->ten_chude;
                                        ?>
                                    </h3>
                                    @foreach ($cungchude as $item)
                                    <div class="d-flex justify-content-between align-items-center py-1">
                                        <div>
                                            <a href="/baihoc/{{$item->slug}}">
                                                <h6 class="mb-0 product--title">{{$item->ten_baihoc}}</h6>
                                            </a>
                                            
                                        </div>
                                        
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection
