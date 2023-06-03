@if(session('success'))
<div class="alert border-0 bg-light-success alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
    <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i>
    </div>
    <div class="ms-3">
        <div class="text-success">{{ session('success')}}</div>
    </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('error'))
<div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
        <div class="fs-3 text-danger"><i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="ms-3">
            <div class="text-danger">{{session('error')}}</div>
            <div class="text-danger"></div>
        </div>
        </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(count($errors)> 0)
<div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
    <div class="fs-3 text-danger"><i class="bi bi-check-circle-fill"></i>
    </div>
    <div class="ms-3">
        <div class="text-danger">Lỗi</div>
        <div class="text-danger"></div>
    </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif