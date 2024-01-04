@extends('layouts.master')

@section('title', 'Product')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div>
        <h4 class="mb-0">{{ trans('order.order_edit') }}</h4>
        <p class="mb-0 text-muted">{{ trans('order.order_edit_desc') }}</p>
    </div>
</div>
<!-- End Page Header -->

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger mx-4" role="alert">
    {{ $error }}
</div>
@endforeach
@endif
<form action="{{route('view.order.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Thông Tin Đơn Hàng
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required">Tên</label>
                            <input type="text" class="form-control" name="name" value="{{$model->name }}" placeholder="Tên" aria-label="Họ tên">
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label ">Số Lượng</label>
                            <input type="number" class="form-control" value="{{$model->quantity }}" name="quantity" placeholder="Số Lượng" aria-label="quantity">
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label ">Hình ảnh</label>
                            @if($model->thumbnail)
                            <img src="{{$model->thumbnail_url}}" width="70" height="70" alt="">
                            @endif
                            <input type="file" class="form-control" name="file" placeholder="Hình ảnh" aria-label="file">
                        </div>
                        <div class="col-md-6 mb-3 ">
                            <label class="form-label ">Mô tả</label>
                            <textarea type="number" class="form-control" name="description" placeholder="Mô tả" aria-label="description">{{$model->description }}</textarea>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-none border-top-0">

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