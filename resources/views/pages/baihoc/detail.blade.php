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
@section('javascript')
<script>

    class TableOfContents {
    /*
        The parameters from and to must be Element objects in the DOM.
    */
    constructor({ from, to }) {
        this.fromElement = from;
        this.toElement = to;
        // Get all the ordered headings.
        this.headingElements = this.fromElement.querySelectorAll("h1, h2, h3, h4, h5, h6");
        this.tocElement = document.createElement("div");
    }

    /*
        Get the most important heading level.
        For example if the article has only <h2>, <h3> and <h4> tags
        this method will return 2.
    */
    getMostImportantHeadingLevel() {
        let mostImportantHeadingLevel = 6; // <h6> heading level
        for (let i = 0; i < this.headingElements.length; i++) {
            let headingLevel = TableOfContents.getHeadingLevel(this.headingElements[i]);
            mostImportantHeadingLevel = (headingLevel < mostImportantHeadingLevel) ?
                headingLevel : mostImportantHeadingLevel;
        }
        return mostImportantHeadingLevel;
    }

    /*
        Generate a unique id string for the heading from its text content.
    */
    static generateId(headingElement) {
        return headingElement.textContent.replace(/\s+/g, "_");
    }

    /*
        Convert <h1> to 1 … <h6> to 6.
    */
    static getHeadingLevel(headingElement) {
        switch (headingElement.tagName.toLowerCase()) {
            case "h1": return 1;
            case "h2": return 2;
            case "h3": return 3;
            case "h4": return 4;
            case "h5": return 5;
            case "h6": return 6;
            default: return 1;
        }
    }

    generateToc() {
        let currentLevel = this.getMostImportantHeadingLevel() - 1,
            currentElement = this.tocElement;

        for (let i = 0; i < this.headingElements.length; i++) {
            let headingElement = this.headingElements[i],
                headingLevel = TableOfContents.getHeadingLevel(headingElement),
                headingLevelDifference = headingLevel - currentLevel,
                linkElement = document.createElement("a");

            if (!headingElement.id) {
                headingElement.id = TableOfContents.generateId(headingElement);
            }
            linkElement.href = `#${headingElement.id}`;
            linkElement.textContent = headingElement.textContent;

            if (headingLevelDifference > 0) {
                // Go down the DOM by adding list elements.
                for (let j = 0; j < headingLevelDifference; j++) {
                    let listElement = document.createElement("ol"),
                        listItemElement = document.createElement("li");
                    listElement.appendChild(listItemElement);
                    currentElement.appendChild(listElement);
                    currentElement = listItemElement;
                }
                currentElement.appendChild(linkElement);
            } else {
                // Go up the DOM.
                for (let j = 0; j < -headingLevelDifference; j++) {
                    currentElement = currentElement.parentNode.parentNode;
                }
                let listItemElement = document.createElement("li");
                listItemElement.appendChild(linkElement);
                currentElement.parentNode.appendChild(listItemElement);
                currentElement = listItemElement;
            }

            currentLevel = headingLevel;
        }

        this.toElement.appendChild(this.tocElement.firstChild);
    }
}

document.addEventListener("DOMContentLoaded", () =>
    new TableOfContents({
        from: document.querySelector("#contents"),
        to: document.querySelector("#toc")
    }).generateToc()
);
</script>
@endsection
