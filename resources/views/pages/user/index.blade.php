@extends('layouts.master')

@section('title', 'User')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h4 class="mb-0">Nhân Viên</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nhân Viên</li>
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

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 mb-2">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12" id="list-data">
            <div class="card card-table">
                <div class=" card-header p-0 d-flex justify-content-between mb-2">
                    Danh Sách Người Dùng
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light bg-transparent rounded-pill" data-bs-toggle="dropdown"><i class="fe fe-more-horizontal"></i></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0);">10</a>
                        <a class="dropdown-item" href="javascript:void(0);">20</a>
                        <a class="dropdown-item" href="javascript:void(0);">30</a>
                        <a class="dropdown-item" href="javascript:void(0);">Tất cả</a>
                    </div>
                </div>

                <div class="table-responsive country-table">
                    <table class="table table-striped table-bordered mb-0 text-nowrap gridjs-table">
                        <thead class="gridjs-thead">
                            <tr class="gridjs-tr">
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">ID</div>
                                        <button class="btn btn-outline-light btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-down"></i>
                                        </button>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Họ Tên</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-up"></i>
                                        </button>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Email</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-up"></i>
                                        </button>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Chức Vụ</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-up"></i>
                                        </button>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Số Điện Thoại</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-up"></i>
                                        </button>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Ngày tạo</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-up"></i>
                                        </button>
                                    </div>
                                </th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in list" :key="item.id">
                                <td class="fw-medium">((item.id))</td>
                                <td>((item.name))</td>
                                <td>((item.email))</td>
                                <td>((item.role.nice_name))</td>
                                <td>((item.phone))</td>
                                <td>((item.created_at))</td>
                                <td>
                                    <div class="hstack gap-2 ">
                                        <a :href="`{{asset('user')}}/edit/`+item.id" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <form :action="`{{asset('user')}}/`+item.id" :id="'formDelete_'+((item.id))" class="pt-1" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a href="##" @click="deleteItem(item.id)" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="card-footer p-8pt">
                        <ul class="pagination justify-content-start pagination-xsm m-0">

                            <li class="page-item disabled" v-if="page <= 1">
                                <button class="page-link" type="button" aria-label="Previous">
                                    <i class="fe fe-arrow-left"></i>
                                </button>
                            </li>
                            <li class="page-item" v-if="page > 1" @click="onPrePage()">
                                <button class="page-link" type="button" aria-label="Previous">
                                    <i class="fe fe-arrow-left"></i>
                                </button>
                            </li>


                            <li class="page-item disabled" v-if="page > 3 ">
                                <button class="page-link" type="button">
                                    <span>...</span>
                                </button>
                            </li>
                            <li class="page-item" v-for="item in listPage" v-if="page > (item - 3) && page < (item + 3) " @click="onPageChange(item)" v-bind:class="page == item ? 'active' : ''">
                                <button class="page-link" type="button" aria-label="Page 1">
                                    <span>((item))</span>
                                </button>
                            </li>

                            <li class="page-item disabled" v-if="page > count - 1 || count == 1">
                                <button class="page-link" type="button">
                                    <i class="fe fe-arrow-right"></i>
                                </button>
                            </li>

                            <li class="page-item" @click="onNextPage()" v-if="page <= count - 1 && count > 1">
                                <button class="page-link" type="button">
                                    <i class="fe fe-arrow-right"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->

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