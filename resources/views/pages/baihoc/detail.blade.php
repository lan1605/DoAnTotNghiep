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
        <div style="background-color: white">
            <div class="container mt-2">
                
                <div class="row my-5">
                    <div class="col-12 col-lg-8 ">
                        <div >
                            <div class="card-header py-2 " >
                                <h2 class="fw-500 text-primary">{{$chitiet->ten_baihoc}}</h2>
                                <p class="py-0"><strong>Chủ đề: </strong>
                                    <?php
                                        $chude = App\Models\ChuDe::find($chitiet->id_chude);
                                        echo $chude->ten_chude;    
                                    ?>
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
                                    <button type="submit" class="btn btn-success px-5"><i class="bx bx-credit-card-front"></i> Làm bài tập</button>
                                </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="row g-2 mt-1">
                                    <div class="col-12" id="contents">
                                        {!! $chitiet->noi_dung !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h3>Cùng chủ đề</h3>
                                @foreach ($cungchude as $item)
                                <div class="card">
                                    <div class="card-body" style="cursor: pointer" title="{{$item->ten_baihoc}}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <a href="/baihoc/{{$item->slug}}">
                                                    <h6 class="mb-0 product--title">{{$item->ten_baihoc}}</h6>
                                                </a>
                                                <p class="mb-0">Chủ đề: <span>
                                                    <?php
                                                        $chude = App\Models\ChuDe::find($item->id_chude);
                                                        echo $chude->ten_chude;
                                                        ?>
                                                </span></p>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="card sticky-top">
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
                    </div>
                </div>
            </div>
            
        </div>

    </main>
@endsection
