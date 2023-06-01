@extends('admin.layout.index')

@section('content')
<main class="page-content">
    <!--breadcrumb-->
    @include('layouts.breadcrumb')
    <!--end breadcrumb-->
    @include('layouts.notificationLogin')
    @include('layouts.notication')
        <div class="row">
            <div class="col-xl-9 mx-auto">
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="card-title d-flex align-items-center">
										<h5 class="mb-0">Chi tiết liên hệ</h5>
									</div>
									<hr/>
									<div class="row mb-3">
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Họ tên: </strong>{{$lienhe->ten}}</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Địa chỉ email: </strong>{{$lienhe->email}}</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Thời gian gửi: </strong>{{$lienhe->created_at->format('H:s:i d-m-y')}}</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Trạng thái: </strong>{{$lienhe->noidung_phanhoi==null ? 'Chưa phản hồi' : 'Đã phản hồi'}}</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Tiêu đề: </strong>Liên hệ với chúng tôi</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										<div class="col-6">
                                            <p class="py-0 mb-1"><strong>Mailer: </strong>SMTP Server</p>
                                            {{-- <hr style="margin-top: 0.5rem"> --}}
                                        </div>
										
									</div>
                                    <hr>
									<div class="row">
										<label class="col-sm-3 col-form-label"><strong>Nội dung liên hệ</strong>
                                        </label>
										<div class="col-sm-12">
											{{$lienhe->noidung_lienhe}}
										</div>
									</div>
                                    <hr>
									<div class="row">
										<label class="col-sm-3 col-form-label"><strong>Nội dung phản hồi</strong>
                                        </label>
                                        @if ($lienhe->noidung_phanhoi==null)
										<div class="col-sm-12 mx-auto">
											
                                                <form action="/dashboard/lienhe/{{$lienhe->id}}" method="post">
                                                    @csrf
                                                    <textarea name="noi_dung" id="" cols="30"  placeholder="Nội dung phản hồi.." class="form-control"></textarea>
                                                
                                            </div>
                                            <div class="col-lg-12 text-md-end mt-2">
                                                <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                                            </div>
                                        </form>
                                            @else
                                            <div class="col-sm-12">
                                                {{$lienhe->noidung_phanhoi}}
                                            </div>
                                            @endif
										
									</div>
								</div>
							</div>
						</div>
            </div>
        </div>
</div>

    

</div>

</main>
@endsection