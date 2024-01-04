@extends('layouts.master')

@section('title', 'Product')

@section('content')
<form action="{{route('view.product.store')}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Thêm nguyên liêu</h4>
        </div>
        <div class="main-dashboard-header-right">
            <div class="d-flex my-xl-auto right-content align-items-center">
                <div>
                    <a href="{{route('view.product.index')}}" class="btn btn-danger btn-icon me-2 btn-b" title="Quay lại danh sách product">
                        <i class="bi bi-box-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- row -->
    <!-- Start:: row-1 -->

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger mx-4" role="alert">
        {{ $error }}
    </div>
    @endforeach
    @endif

    <div class="row">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Thông tin nguyên liêu
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required">Tên</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Tên" aria-label="Họ tên">
                    </div>

                    <div class="col-md-6 mb-3 ">
                        <label class="form-label ">Số Lượng</label>
                        <input type="number" class="form-control" value="{{ old('quantity') }}" name="quantity" placeholder="Số Lượng" aria-label="quantity">
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <label class="form-label ">Hình ảnh</label>
                        <input type="file" class="form-control" name="file" placeholder="Hình ảnh" aria-label="file">
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <label class="form-label ">Mô tả</label>
                        <textarea type="number" class="form-control" name="description" placeholder="Mô tả" aria-label="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</form>
@endsection

@section('script-footer')
<script src="{{ asset('assets/js/prism-custom.js') }}"></script>

<script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>

@endsection