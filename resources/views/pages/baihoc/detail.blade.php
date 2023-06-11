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
                                <h1 class="fw-500 text-primary">{{$chitiet->ten_baihoc}}</h1>
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
                                <h2 class="py-0"><strong>
                                    <?php
                                        $chude = App\Models\ChuDe::find($chitiet->id_chude);
                                        echo $chude->ten_chude;    
                                    ?>
                                    </strong>
                                </h2>
                                <div class="d-flex mt-2 justify-content-center gap-2">
                                    <?php
                                        $check = App\Models\LuuBaiHoc::where('id_baihoc', $chitiet->id_baihoc)->first();
                                    ?>
                                    @if (isset($check->id_baihoc))
                                        <a href="/bai-hoc/{{$chitiet->slug}}/huy" class="btn btn-danger px-5" id="huybaihoc"> <i class="bi bi-bookmark-check-fill"></i>Xóa khỏi danh sách</a>
                                        
                                    @else
                                        <a href="/bai-hoc/{{$chitiet->slug}}/luu" class="btn btn-danger px-5" id="luubaihoc"> <i class="bi bi-bookmark-check-fill"></i> Lưu bài học</a>
                                    @endif
                                    <?php
                                        $baitap = App\Models\BaiTap::where('id_baihoc', $chitiet->id_baihoc)->first();
                                    ?>
                                        @if (isset($baitap->id_baihoc))
                                            @php
                                                $solanlambai = App\Models\KetQua::where('id_baitap', $baitap->id_baitap)->where('id_hocvien', Auth::user()->id)->get();
                                            @endphp
                                            @if (count($solanlambai)==3)
                                                
                                            @else
                                                <a href="/bai-tap/{{$baitap->slug}}" class="btn btn-success px-5" id="lambaitap"> <i class="bx bx-credit-card-front"></i> Làm bài tập</a>
                                            @endif

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
                                    <article>
                                        {!! $chitiet->noi_dung !!}
                                    </article>
                                    <div class="d-flex justify-content-between">
                                        @if ($prev)
                                        @php
                                            $baitruoc = App\Models\BaiHoc::find($prev);
                                        @endphp
                                            <h5>
                                                <div class="d-flex align-items-center">
                                                    <a href="/bai-hoc/{{$baitruoc->slug}}" title="{{$baitruoc->ten_baihoc}}">
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
                                                    <a href="/bai-hoc/{{$baitruoc->slug}}" title="{{$baitruoc->ten_baihoc}}">
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
                                            <a href="/bai-hoc/{{$item->slug}}">
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
<style>
    .toc-h2 { margin-left: 0.5em }
    .toc-h3 { margin-left: 1.75em }
    .toc-h4 { margin-left: 3em }
    .toc-h5 { margin-left: 4.25em }
    .toc-h6 { margin-left: 5.5em }
</style>
@section('javascript')
<script>
    // Lấy tất cả các heading trong bài viết
        // const contents = document.querySelector("#contents");
        const headings = document.querySelectorAll('article h1, article  h2, article  h3, article  h4, article h5, article h6');
        // if (headings.length === 0) return;

        // Khai bào nơi mà TOC sẽ được chèn vào
        const tocContainer = document.querySelector('#toc');

        // Xác định cấp độ bắt đầu của TOC (bởi vì không phải bài viết nào cũng có thẻ H1, hoặc H2)
        const startingLevel = headings[0].tagName[1];

        // Tạo TOC rỗng
        const toc = document.createElement('ul');
        toc.style = 'list-style: none';

        // Theo dõi các cấp độ heading trước đó
        const prevLevels = [0, 0, 0, 0, 0, 0];

        // Lặp qua từng heading và thêm chúng vào TOC
        for (let i = 0; i < headings.length; i++) {
        const heading = headings[i];
        const level = parseInt(heading.tagName[1]);

        // Tăng các cấp độ trước đó lên đến cấp độ hiện tại
        prevLevels[level - 1]++
        for (let j = level; j < prevLevels.length; j++) {
            prevLevels[j] = 0;
        }

        // Tạo số mục cho mục đó dựa trên các cấp độ trước đó
        // và loại bỏ số 0 nếu trường hợp h1 -> h3 (không có h2)
        // Sẽ tạo ra các đề mục ví dụ như:
        // 1. Heading h1a
        //     1.1 Heading h2
        // 2. Heading h1b
        //          2.1 Heading h3 (đẹp hơn 2.0.1 Heading h3)
        const sectionNumber = prevLevels.slice(startingLevel - 1, level).join('.').replace(/\.0/g, ".");

        // Tạo ID mới và gán vào heading
        // Phải làm phần này để click vào mục lục có thể di chuyển đến được.
        const newHeadingId = `${heading.textContent.toLowerCase().replace(/ /g, '-')}`
        heading.id = newHeadingId

        // Tạo liên kết mục cho heading
        const anchor = document.createElement('a')
        anchor.setAttribute('href', `#${newHeadingId}`)
        anchor.textContent = heading.textContent

        // Thêm event listener để cuộn đến liên kết khi nhấp chuột
        anchor.addEventListener('click', (event) => {
            event.preventDefault()
            const targetId = event.target.getAttribute('href').slice(1)
            const targetElement = document.getElementById(targetId)
            targetElement.scrollIntoView({ behavior: 'smooth' })
            // Thêm anchor vào URL khi click
            history.pushState(null, null, `#${targetId}`)
        })

        // Tạo thẻ <li> để thêm vào TOC
        const listItem = document.createElement('li')
        listItem.textContent = sectionNumber
        listItem.appendChild(anchor)

        // Thêm CSS class cho từng mục lục
        // Ví dụ "toc-item toc-h1", "toc-item toc-h2"
        const className = `toc-${heading.tagName.toLowerCase()}`
        listItem.classList.add('toc-item')
        listItem.classList.add(className)

        // Bỏ thẻ <li> vừa tạo vào TOC
        toc.appendChild(listItem)
        }

        // Thêm các TOC item vào toc contaner
        tocContainer.innerHTML = ''  
        tocContainer.appendChild(toc);

        // Kiểm tra xem URL có chứa anchor hay không
  if (window.location.hash) {
    // Decode hash để lấy ID của anchor
    const anchorId = decodeURIComponent(window.location.hash.slice(1));

    // Lấy phần tử có ID tương ứng với anchor
    const anchorElement = document.getElementById(anchorId);

    // Nếu phần tử tồn tại, cuộn mượt đến phần tử đó 
    if (anchorElement) {
      anchorElement.scrollIntoView({behavior: 'smooth'});
    }
  }

</script>
@endsection
