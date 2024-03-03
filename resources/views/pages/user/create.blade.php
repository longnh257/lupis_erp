@extends('layouts.master')

@section('title', 'User')

@section('content')
<form action="{{route('view.user.store')}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Thêm user</h4>
        </div>
        <div class="main-dashboard-header-right">
            <div class="d-flex my-xl-auto right-content align-items-center">
                <div>
                    <a href="{{route('view.user.index')}}" class="btn btn-danger btn-icon me-2 btn-b" title="Quay lại danh sách user">
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
        {!! $error !!}
    </div>
    @endforeach
    @endif

    <div class="row">
        <div class="col-xl-6">
            <div class="card custom-card  shadow-none">
                <div class="card-body">
                    <div class="card-title">
                        Thông tin user
                    </div>
                    <div class="row border rounded pt-3">
                        <div class="col-md-12 mb-3">
                            <label class="form-label required">Họ Tên</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Họ Tên" aria-label="Họ tên" required>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" placeholder="Email" aria-label="email" required>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Chức vụ</label>
                            <select type="text" class="form-control" name="role_id" required>
                                <option value="">Chọn chức vụ cho user</option>
                                @foreach($roles as $item)
                                <option value="{{$item->id}}" {{old('role_id')==$item->id ? "selected" : ""}}>{{$item->nice_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Mật khẩu</label>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                        </div>

                        <div class="col-md-12 mb-3 ">
                            <label class="form-label ">Địa chỉ</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="Địa chỉ">
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại" aria-label="Số điện thoại">
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label">Sinh Nhật</label>
                                    <input type="date" class="form-control" value="{{ old('dateofbirth') }}" aria-label="dateofbirth">
                                </div>
                            </div>

                        </div>


                        <div class="col-md-6">
                            <label class="form-label mb-3">Giới Tính</label>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="1" name="gender" id="gender1" checked>
                                    <label class="form-check-label" for="gender1">
                                        Nam
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="0" name="gender" id="gender2">
                                    <label class="form-check-label" for="gender2">
                                        Nữ
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="2" name="gender" id="gender3">
                                    <label class="form-check-label" for="gender3">
                                        Khác
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-title mt-3">
                        Cấu hình lương
                    </div>
                    <div class="row border rounded pt-3" id="App">

                        <div class="col-md-12 mb-3 ">
                            <label class="form-label required">Cách tính lương</label>
                            <select type="text" class="form-control" name="salary_type" v-model="salary_type" required>
                                <option value="by_shift">Theo ca</option>
                                <option value="by_revenue">Theo theo doanh thu</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3 " v-if="salary_type=='by_shift'">
                            <label class="form-label required">Lương cơ bản mỗi ca</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="basic_salary_per_shift" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3 " v-if="salary_type=='by_revenue'">
                            <label class="form-label required">Tỉ lệ % theo doanh thu</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" name="revenue_percentage" step=0.01 required>
                                <div class="input-group-append">
                                    <span class="input-group-text">% Doanh Thu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-end pb-3 pe-2">
                    <button type="submit" class="btn btn-primary">Thêm</button>
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


<script type="text/javascript">
    var CSRF_TOKEN = jQuery('meta[name="csrf-token"]').attr('content');
    var S_HYPEN = "-";
     var options = {
        durations: {
            alert: 0,
            warning: 0,
            success: 2000,
        },
        labels: {
            alert: 'Lỗi',
            warning: 'Chú Ý',
            success: 'Thành Công',
        },
        icons: {
            enabled: false
        }
    }
    var notifier = new AWN(options);

    new Vue({
        el: '#App',
        data: {
            salary_type: 'by_shift',
        },
        delimiters: ["((", "))"],
        mounted() {},
        computed: {},

        methods: {},
    });
</script>
@endsection