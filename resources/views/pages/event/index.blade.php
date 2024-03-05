@extends('layouts.master')

@section('title', 'User')

@section('content')

<?php

use Illuminate\Support\Facades\Auth;

$current_user = Auth::user();
?>
<div class="container-fluid" id="list-data">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div class="my-auto">
            <h4 class="mb-0">Lịch</h4>
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Trang Chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Page Header -->
    <!-- row opened -->
    <div class="row">

        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-body">
                    <div id='calendar' class="mt-0"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-header d-grid">
                    <div id="external-events">
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-primary border border-primary">
                            <div class="fc-event-main">Ngày Làm</div>
                        </div>
                        <div class="fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event bg-warning border border-warning">
                            <div class="fc-event-main">Ngày Nghỉ</div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="external-events" class="p-3" @click="openAddModal">
                        <button class="btn btn-primary-light btn-wave"><i class="ri-add-line align-middle me-1 fw-semibold d-inline-block"></i>Thêm lịch</button>
                    </div>
                </div>
            </div>

            @if($current_user->checkUserRole())
         <!--    <div class="card custom-card">
                <div class="card-header d-grid">
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
            </div> -->
            @endif
        </div>


        <div class="modal fade" id="add_event_modal" tabindex="-1" aria-labelledby="add_event_modal" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{route('view.event.store')}}" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Thêm lịch</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex mb-2">
                                <div class="form-check col-6">
                                    <input class="form-check-input" type="radio" name="event_type" value="work" id="event_type1" v-model="event_type">
                                    <label class="form-check-label" for="event_type1">
                                        Đăng ký Ngày Làm
                                    </label>
                                </div>
                                <div class="form-check col-6">
                                    <input class="form-check-input" type="radio" name="event_type" value="off" id="event_type2" v-model="event_type">
                                    <label class="form-check-label" for="event_type2">
                                        Đăng ký Ngày Nghỉ
                                    </label>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="start" class="col-form-label required">Ngày:</label>
                                <input type="date" class="form-control" name="start" id="datePickerId" v-model="selected_date" required>
                            </div>

                            @if($current_user->checkUserRole())
                            <div class="mb-2" v-if="event_type=='work'">
                                <label for="user_id" class="col-form-label required">Nhân viên</label>
                                <select type="date" class="form-control" name="user_id" v-model="user" required>
                                    <option value="">Chọn nhân viên</option>
                                    @foreach($users as $key => $user)
                                    <option value="{{$user->id}}">{{$user->id . " " . $user->name."  -  ".$user->role_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="mb-2" v-if="event_type=='work'">
                                <label for="shift" class="col-form-label">Ca làm việc:</label>
                                <select type="date" class="form-control" name="shift" v-model="shift">
                                    <option value="1">Ca 1</option>
                                    <option value="2">Ca 2</option>
                                    <option value="3">Ca 3</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ghi chú:</label>
                                <textarea class="form-control" id="message-text" name="note" v-model="note"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" action="/event">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="edit_event_modal">
            @method("PUT")
            @csrf
            <div class="modal-dialog">
                <form v-bind:action="selectedEvent.url" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Phê duyệt lịch ((selectedEvent.event_type=='off'? ' - Nghỉ Phép' : ' - Làm Việc'))</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-0">
                            <div class="mb-2">
                                <label for="start" class="col-form-label">Ngày:</label>
                                <input type="date" class="form-control" id="datePickerId" disabled v-model="selectedEvent.start">
                            </div>

                            <div class="mb-2" v-if="selectedEvent.event_type=='work'">
                                <label for="shift" class="col-form-label">Ca làm việc:</label>
                                <select type="date" class="form-control" disabled v-model="selectedEvent.shift">
                                    <option value="1">Ca 1</option>
                                    <option value="2">Ca 2</option>
                                    <option value="3">Ca 3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Ghi chú của nhân viên:</label>
                                <textarea class="form-control" id="message-text" v-model="selectedEvent.note" disabled></textarea>
                            </div>

                            <div class="border-top"></div>

                            <div class="mb-2" v-if="event_type=='work'">
                                <label for="shift" class="col-form-label">Trạng Thái:</label>
                                <select type="date" class="form-control" name="status" v-model="selectedEvent.status">
                                    <option value="0">Đợi Duyệt</option>
                                    <option value="1">Đã Duyệt</option>
                                    <option value="2">Đã Hủy</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Lý Do Hủy:</label>
                                <textarea class="form-control" id="message-text" name='reason' v-model="selectedEvent.reason"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" action="/event">Cập nhật</button>
                        </div>
                    </div>
                </form>
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
<script src="{{ asset('assets/js/csrf.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>

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
        el: '#list-data',
        data: {
            sortDirection: 'desc',
            sortBy: 'id',
            selected_date: '',
            shift: '1',
            user: '',
            event_type: 'work',
            note: '',
            count: 0,
            page: 1,
            list: [],
            workEvents: [],
            offEvents: [],
            conditionSearch: '',
            listPage: [],
            showCount: 10,
            selectedEvent: {}
        },
        delimiters: ["((", "))"],
        mounted() {
            const that = this;
            this.onLoadPagination();
            var today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            var datePickerId = document.getElementById("datePickerId");
            datePickerId.min = tomorrow.toISOString().split("T")[0];
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
                    url: "{{route('api.event.user-event')}}" + conditionSearch,
                    success: function(data) {
                        console.log(data);
                        that.offEvents = data.offEvents;
                        that.workEvents = data.workEvents;
                        that.renderCalendar()
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
            openAddModal() {
                console.log(1);
                $('#add_event_modal').modal('show');
            },
            renderCalendar() {
                const that = this;
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'vi',
                    selectable: true,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek,listMonth'
                    },
                    buttonText: {
                        today: "Hôm Nay",
                        dayGridMonth: "Tháng",
                        dayGridWeek: "Tuần",
                        timeGridWeek: "Tuần",
                        timeGridDay: "Ngày",
                        listMonth: "Danh Sách",
                    },
                    noEventsMessage:"Không có sự kiện",
                    allDayText: "",
                    fixedWeekCount: false,
                    navLinks: true,
                    eventSources: [this.workEvents, this.offEvents],
                    dayMaxEvents: true,
                    moreLinkContent: function(args) {
                        return 'Xem tất cả';
                    },
                    select: function(info) {
                        var check = new Date(info.start);
                        var today = new Date();
                        that.selected_date = info.startStr
                        console.log(info.startStr);
                        console.log(that.selected_date);
                        if (check < today) {} else {
                            $('#add_event_modal').modal('show');
                        }
                    },

                    eventClick: function(info) {
                        var check = new Date(info.event.start);
                        var today = new Date();
                        that.selected_date = info.event.startStr
                        console.log(info.event.startStr);
                        <?php
                        if ($current_user->checkUserRole()) {
                        ?>
                            /*   var check = new Date(info.event.start);
                              var today = new Date(); */
                            that.selected_date = info.startStr
                            that.selectedEvent.url = '{{asset("event")}}/' + info.event.id
                            that.selectedEvent.start = info.event.startStr
                            that.selectedEvent.status = info.event.extendedProps.status
                            that.selectedEvent.shift = info.event.extendedProps.shift
                            that.selectedEvent.note = info.event.extendedProps.note
                            that.selectedEvent.reason = info.event.extendedProps.reason
                            that.selectedEvent.event_type = info.event.extendedProps.event_type
                            console.log(that.selectedEvent);
                            /*     if (check < today) {} else {
                                $('#edit_event_modal').modal('show');
                            } */
                            $('#edit_event_modal').modal('show');
                        <?php
                        } else {

                        ?>
                            if (check < today) {} else {
                                if (info.event.extendedProps.status == 1) {
                                    Swal.fire({
                                        title: 'Lỗi',
                                        text: "Lịch đã được duyệt, vui lòng liên hệ quản lý nếu cần sửa đổi!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                    })
                                } else {
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
                                            jQuery.ajax({
                                                method: 'DELETE',
                                                url: `{{route('api.event.list')}}/${info.event.id}`,
                                                success: function(data) {
                                                    console.log(data);
                                                    info.event.remove()
                                                    notifier.success('Lịch đã được xóa!');
                                                },
                                                error: function(xhr, textStatus, error) {
                                                    console.log(xhr, textStatus, error);
                                                    notifier.warning('Có lỗi xảy ra!');
                                                }
                                            });
                                        }
                                    })
                                }
                            }
                        <?php
                        }
                        ?>

                    },
                    <?php
                    if (!$current_user->checkUserRole()) {
                    ?>
                        selectOverlap: () => {
                            Swal.fire({
                                title: 'Lỗi',
                                text: "Chỉ được tạo 1 sự kiện cho 1 ngày!",
                                icon: 'warning',
                            })
                            return false
                        }
                    <?php
                    }
                    ?>
                });
                calendar.render();
            },
        },
    });
</script>


@if (session('changePasswordAlert'))
<script>
    notifier.warning(`{{ session('changePasswordAlert') }}`);
</script>
@endif

@if ($errors->any())
<script>
    let alertMessage = `
    @foreach ($errors->all() as $error)
    <br>
        {{ $error }}
    @endforeach
    `
    notifier.alert(alertMessage);
</script>
@endif

@if (session('error'))
<script>
    notifier.alert(`{{ session('error') }}`);
</script>
@endif

@if (session('success'))
<script>
    notifier.success(`{{ session('success') }}`);
</script>
@endif
@endsection