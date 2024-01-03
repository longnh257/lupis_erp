@extends('layouts.master')

@section('title', 'User')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h4 class="mb-0">Thông tin user</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin user</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center">
            <div>
                <a href="{{route('view.user.create')}}" class="btn btn-info btn-icon btn-b" target="_blank">
                    <i class="fe fe-plus"></i></a>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <form action="{{route('view.user.update-profile')}}" method="post" enctype="multipart/form-data" class="container-fluid">
        @csrf
        @method('PUT')
        <!-- row opened -->
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 mb-2">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
                @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="ps-0">
                            <div class="main-profile-overview  text-center">
                                <div class="main-img-user profile-user">
                                    <img alt="" src="{{asset('assets/images/user.jpg')}}"><!-- <a class="fe fe-camera profile-edit text-primary" href="JavaScript:void(0);"></a> -->
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="text-center d-block" style="width:100%;">
                                        <h5 class="main-profile-name t">{{$model->name}}</h5>
                                        <p class="main-profile-name-text">{{$model->role_name}}</p>
                                    </div>
                                </div>


                            </div><!-- main-profile-overview -->
                            <hr class="border-0">
                            <label class="main-content-label fs-13 mb-2">Giới tính:</label>
                            <div class="main-profile-social-list">
                                <span>
                                    {{$model->gender==1?"Nam":""}}
                                    {{$model->gender==0?"Nữ":""}}
                                    {{$model->gender==2?"Khác":""}}
                                </span>
                            </div>
                            <label class="main-content-label fs-13 mb-2 mt-3">Địa chỉ:</label>
                            <div class="main-profile-social-list">
                                <span>
                                    {{$model->address? $model->address: "Chưa cập nhật" }}
                                </span>
                            </div>
                            <label class="main-content-label fs-13 mb-2 mt-3">Ngày Sinh:</label>
                            <div class="main-profile-social-list">
                                <span>
                                    {{$model->birthday? $model->birthday: "Chưa cập nhật" }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="main-content-label tx-13 mg-b-25">
                            Liên Hệ
                        </div>
                        <div class="main-profile-contact-list">
                            <div class="media">
                                <div class="media-icon bg-info-transparent text-info">
                                    <i class="las la-envelope"></i>
                                </div>
                                <div class="media-body">
                                    <span>Email</span>
                                    <div>
                                        <a href="mailto:{{$model->email}}">{{$model->email}}</a>
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-icon bg-primary-transparent text-primary">
                                    <i class="icon ion-md-phone-portrait"></i>
                                </div>
                                <div class="media-body">
                                    <span>Di động:</span>
                                    <div>
                                        <a href="tel:{{$model->phone}}">{{$model->phone}}</a>
                                    </div>
                                </div>
                            </div>


                        </div><!-- main-profile-contact-list -->
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 main-content-label">Thông tin cá nhân</div>
                        <div class="form-horizontal">

                            <div class="mb-4 main-content-label"></div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label required">Họ tên</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Họ tên" name="name" value="{{$model->name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Số điện thoại</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Số điện thoại" name="phone" value="{{$model->phone}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Ngày sinh</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="birthday" value="{{$model->birthday}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Giới tính</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select type="date" class="form-control" name="gender" value="{{$model->gender}}">
                                            <option value="1" {{$model->gender==1 ? "selected" : ""}}>Nam</option>
                                            <option value="0" {{$model->gender==0 ? "selected" : ""}}>Nữ</option>
                                            <option value="2" {{$model->gender==2 ? "selected" : ""}}>Khác</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Địa chỉ</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="address" rows="2" placeholder="Address">{{$model->address}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4 main-content-label">Thông tin tài khoản</div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label ">Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Email" value="{{$model->email}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Mật khẩu cũa</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="Mật khẩu cũ" name="old_password" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Mật khẩu mới</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="Mật khẩu mới" name="password" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="form-label">Xác nhận mật khẩu mới</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" placeholder="Xác nhận mật khẩu mới" name="password_confirmation" value="">
                                    </div>
                                </div>
                            </div>
                            <i>(Để trống mật khẩu nếu không muốn thay đổi)</i>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row -->
    </form>
</div>


@endsection

@section('script-footer')

<!-- Chartjs Chart JS -->
<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->

<script src="{{ asset('assets/js/prism-custom.js') }}"></script>

<script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>



<script type="text/javascript">
    var CSRF_TOKEN = jQuery('meta[name="csrf-token"]').attr('content');
    var S_HYPEN = "-";
    var options = {}
    var notifier = new AWN(options);

    new Vue({
        el: '#list-data',
        data: {
            sortDirection: 'desc',
            sortBy: 'id',
            count: 0,
            page: 1,
            list: [],
            conditionSearch: '',
            listPage: [],
            showCount: 10,
        },
        delimiters: ["((", "))"],
        mounted() {
            const that = this;
            this.onLoadPagination();
        },
        computed: {},

        methods: {
            sort: function(s) {
                if (s === this.sortBy) {
                    this.sortDirection = this.sortDirection === 'asc' ? 'asc' : 'desc';
                }
                this.sortBy = s;
            },
            onPageChange(_p) {
                this.page = _p;
                this.onLoadPagination();
            },
            onPrePage() {
                if (this.page > 1) {
                    this.page = this.page - 1;
                }
                this.onLoadPagination();
            },
            onNextPage() {
                if (this.page < this.count) {
                    this.page = this.page + 1;
                }
                this.onLoadPagination();
            },
            onLoadPagination() {
                const that = this;
                let conditionSearch = '?page=' + this.page;
                conditionSearch += '&showcount=' + this.showCount;
                conditionSearch += '&sortBy=' + this.sortBy;
                conditionSearch += '&sortDirection=' + this.sortDirection;
                this.conditionSearch = conditionSearch;
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('api.user.list')}}" + conditionSearch,
                    success: function(data) {
                        that.list = data.result.data;
                        that.count = data.result.last_page;
                        let pageArr = [];
                        if (that.page - 2 > 0) {
                            pageArr.push(that.page - 2);
                        }
                        if (that.page - 1 > 0) {
                            pageArr.push(that.page - 1);
                        }
                        pageArr.push(that.page);
                        if (that.page + 1 <= that.count) {
                            pageArr.push(that.page + 1);
                        }
                        if (that.page + 2 <= that.count) {
                            pageArr.push(that.page + 2);
                        }
                        that.listPage = pageArr;

                        console.log(that.list);
                    },
                    error: function(xhr, textStatus, error) {
                        notifier.warning('Có lỗi xảy ra!');
                    }
                });
            },
            deleteItem(id) {
                Swal.fire({
                    title: 'Bạn có chắc là muốn xóa ?',
                    text: "Dữ liệu sẽ không thể khôi phục sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        jQuery('#formDelete_' + id).submit();
                    }
                })

            },
        },
    });
</script>
@endsection