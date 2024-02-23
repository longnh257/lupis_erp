@extends('layouts.master')

@section('title', 'User')

@section('content')
<div class="container-fluid" id="list-data">
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
                            <div class="fc-event-main">Ngày nghỉ</div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="external-events" class="p-3">
                        <button class="btn btn-primary-light btn-wave"><i class="ri-add-line align-middle me-1 fw-semibold d-inline-block"></i>Thêm lịch</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="modal fade" id="calendar_event_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="{{route('view.event.store')}}" method="POST">
                        @csrf
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLabel">Thêm lịch</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex gap-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="event_type" value="work" id="event_type1" v-model="event_type">
                                            <label class="form-check-label" for="event_type1">
                                                Ngày Làm
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="event_type" value="off" id="event_type2" v-model="event_type">
                                            <label class="form-check-label" for="event_type2">
                                                Ngày Nghỉ
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label for="start" class="col-form-label">Ngày:</label>
                                        <input type="date" class="form-control" name="start" id="datePickerId" v-model="selected_date">
                                    </div>

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
                                        <textarea class="form-control" id="message-text"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary" action="/event">Đăng ký</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
            event_type: 'work',
            count: 0,
            page: 1,
            list: [],
            workEvents: [],
            offEvents: [],
            conditionSearch: '',
            listPage: [],
            showCount: 10,
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
                        right: 'dayGridMonth,listMonth'
                    },
                    buttonText: {
                        today: "Hôm Nay",
                        dayGridMonth: "Tháng",
                        timeGridWeek: "Tuần",
                        timeGridDay: "Ngày",
                        listMonth: "Danh Sách",
                    },
                    allDayText: "",
                    fixedWeekCount: false,
                    navLinks: true,
                    select: function(info) {
                        var check = new Date(info.start);
                        var today = new Date();
                        that.selected_date = info.startStr
                        console.log(info.startStr);
                        console.log(that.selected_date);
                        if (check < today) {} else {
                            $('#calendar_event_modal').modal('show');
                        }
                    },
                    eventClick: function(info) {
                        console.log(info.event.extendedProps);
                        if (info.event.extendedProps.approved) {
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
                                        },
                                        error: function(xhr, textStatus, error) {
                                            console.log(xhr, textStatus, error);
                                            notifier.warning('Có lỗi xảy ra!');
                                        }
                                    });
                                }
                            })
                        }

                    },
                    dayMaxEvents: true,
                    eventSources: [this.workEvents, this.offEvents],
                });
                calendar.render();
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