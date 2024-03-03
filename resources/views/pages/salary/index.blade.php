@extends('layouts.master')

@section('title', 'Product')

@section('content')
<div class="container-fluid" id="App">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h4 class="mb-0">Bảng Lương</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bảng Lương</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center">
            <div>
                <a @click="openSalaryModal" class="btn btn-info btn-b" target="_blank">
                    <i class="fe fe-plus"></i>
                    Tính Lương
                </a>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!-- row opened -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12 mb-2">
            @if (session('success'))
            <div class="alert alert-success">
                {!! session('success')!!}
            </div>
            @endif
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card card-table">
                <div class=" card-header p-0 d-flex justify-content-between mb-2">
                    <div class="card-title">
                        Danh Sách Đơn Hàng
                    </div>
                </div>
                <form action="" @submit.prevent="filterList">
                    <div class="d-flex flex-rows gap-3 bsalary p-3 mb-3 pb-0 shadow-sm">

                        <div class="form-group col w-auto" style="max-width:220px">
                            <label for="staffs" class="mb-2 fw-bold">Nhân viên: </label>
                            <input type="text" step="0.1" v-model="user_name" class="form-control ">
                        </div>
                        <div class="form-group col w-auto" style="max-width:220px">
                            <label for="staffs" class="mb-2 fw-bold">Trạng thái đơn hàng: </label>
                            <select class="form-control" name="" v-model="status" id="">
                                <option value="">Chọn Trạng Thái</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="in_progress">Đang Xử Lý</option>
                                <option value="pending">Đợi duyệt</option>
                                <option value="cancel">Bị hủy</option>
                            </select>
                        </div>
                        <div class="form-group col w-auto" style="max-width:220px">
                            <label for="staffs" class="mb-2 fw-bold">Ngày tạo đơn: </label>
                            <input type="date" v-model="created_at" class="form-control ">
                        </div>

                        <div class="form-group col w-auto align-self-end d-flex gap-3">
                            <button class=" btn btn-primary " type="submit" @click="filterList">
                                Tìm Kiếm
                            </button>
                            <div class="d-flex my-xl-auto right-content align-items-center">
                                <div>
                                    <a href="#" class="btn btn-info btn-icon btn-b" @click="resetFilter">
                                        <i class="fa-solid fa-rotate-left"></i> </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

                <div class="table-responsive country-table ">
                    <table class="table table-striped table-bordered mb-0 text-nowrap gridjs-table ">
                        <thead class="gridjs-thead">
                            <tr class="gridjs-tr">
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">ID</div>

                                    </div>
                                </th>

                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Nhân viên</div>

                                    </div>
                                </th>

                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Status</div>

                                    </div>
                                </th>

                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Ngày tạo đơn</div>

                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Note</div>

                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort " style="max-width:200px"></th>
                                <th class="gridjs-th gridjs-th-sort "></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in list" :key="item.id">
                                <td class="fw-medium">((item.id))</td>
                                <td>((item.assigned_user?.name))</td>
                                <td class="">
                                    ((item.status_name))
                                </td>

                                <td>((item.salary_date))</td>
                                <td>((item.note))</td>
                                <td style="max-width:200px">
                                    <a :href="`{{asset('salary')}}/edit/`+item.id" class="btn btn-success btn--small d-block mt-2" v-if="item.is_editable"> Chốt Đơn</a>
                                </td>
                                <td>
                                    <div class="hstack gap-2 ">
                                        <a :href="`{{asset('salary')}}/edit/`+item.id" class="text-info fs-14 lh-1"><i class="ri-edit-line"></i></a>
                                        <form :action="`{{asset('salary')}}/`+item.id" :id="'formDelete_'+((item.id))" class="pt-1" method="post">
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


    <div class="modal fade" id="salaryModal" aria-labelledby="salaryModal" aria-hidden="true">
        <form action="{{asset(route('view.salary.store'))}}" method="POST">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Tính lương </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-0">

                        <div class="mb-2 mt-3">
                            <label for="input-month" class="form-label">Tháng</label>
                            <input type="month" name="month" class="form-control" id="input-month">
                        </div>

                        <div class="mb-2 mt-3">
                            <label for="input-month" class="form-label">Ngày phát lương</label>
                            <input type="date" name="payday" class="form-control">
                        </div>

                        <div class="mb-2 mt-3">
                            <label for="shift" class="col-form-label">Nhân Viên</label>
                            <select type="date" class="form-control">
                                <option value="all">Toàn bộ nhân viên</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" action="/event">Cập nhật</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



@endsection

@section('script-footer')

<!-- Chartjs Chart JS -->
<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->

<script src="{{ asset('assets/js/prism-custom.js') }}"></script>

<script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
<!-- Custom JS -->
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
/*     var currentDate = new Date();
    currentDate.setMonth(currentDate.getMonth() - 1);
    var formattedDate = currentDate.toISOString().slice(0, 7);
    console.log(formattedDate);
    document.getElementById("input-month").setAttribute("max", formattedDate); */
</script>


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
            sortDirection: 'desc',
            sortBy: 'id',
            count: 0,
            page: 1,
            user_name: '',
            status: '',
            created_at: '',
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
                conditionSearch += '&user_name=' + this.user_name;
                conditionSearch += '&status=' + this.status;
                conditionSearch += '&created_at=' + this.created_at;
                this.conditionSearch = conditionSearch;
                jQuery.ajax({
                    type: 'GET',
                    url: "{{route('api.salary.list')}}" + conditionSearch,
                    success: function(data) {
                        console.log(data);
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
            filterList() {
                this.onLoadPagination()
            },
            resetFilter() {
                this.user_name = '';
                this.status = '';
                this.created_at = '';
                this.onLoadPagination()
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
            openSalaryModal() {
                $('#salaryModal').modal('show');
            },
        },
    });
</script>
@endsection