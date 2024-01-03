@extends('layouts.master')

@section('title', 'User')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div>
        <h4 class="mb-0">{{ trans('user.user_edit') }}</h4>
        <p class="mb-0 text-muted">{{ trans('user.user_edit_desc') }}</p>
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
<form action="{{route('view.user.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Thông tin user
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label required">Họ Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ $model->name }}" placeholder="Họ Tên" aria-label="Họ tên">
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control" value="{{ $model->email }}" name="email" placeholder="Email" aria-label="email">
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Chức vụ</label>
                            <select type="text" class="form-control" name="role_id">
                                <option value="">Chọn chức vụ cho user</option>
                                @foreach($roles as $item)
                                <option value="{{$item->id}}" {{$model->role_id==$item->id ? "selected" : ""}}>{{$item->nice_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu">
                        </div>

                        <div class="col-md-12 mb-3 ">
                            <label class="form-label ">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ $model->address }}" placeholder="Địa chỉ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $model->phone }}" placeholder="Số điện thoại" aria-label="Số điện thoại">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Sinh Nhật</label>
                                    <input type="date" class="form-control" value="{{ $model->birthday }}" value="{{ $model->birthday }}" aria-label="birthday">
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label mb-3">Giới Tính</label>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name="gender" id="gender1" {{$model->gender==1 ? "checked" : ""}}>
                                    <label class="form-check-label" for="gender1">
                                        Nam
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="0" name="gender" id="gender2" {{$model->gender==0 ? "checked" : ""}}>
                                    <label class="form-check-label" for="gender2">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="2" name="gender" id="gender3" {{$model->gender==2 ? "checked" : ""}}>
                                    <label class="form-check-label" for="gender3">
                                        Khác
                                    </label>
                                </div>
                            </div>
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