@if (session('success'))
<div class="alert alert-success d-flex align-items-center gap-2" role="alert">
    <i class="ti ti-circle-check fs-3"></i>
    <span class="mt-1">{{ session('success') }}</span>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger d-flex align-items-center gap-2" role="alert">
    <i class="ti ti-x fs-3"></i>
    <span class="mt-1">{{ session('error') }}</span>
</div>
@endif