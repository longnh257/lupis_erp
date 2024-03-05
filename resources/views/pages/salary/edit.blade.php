@extends('layouts.master')

@section('title', 'Product')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 mx-3 page-header-breadcrumb">
</div>
<!-- End Page Header -->

@if(in_array(Auth::user()->role->name, ['superadmin', 'manager']))
<form action="{{route('view.order.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @else
    <form action="{{route('view.order.staff-update',$model->id)}}" @if($model->status == 'in_progress') id="userForm" @endif method="post" enctype="multipart/form-data" class="container-fluid">
        @endif
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xl-6">
                <div class="card custom-card">
                    <div class=" p-4 pb-2">
                        <h4 class=" text-center">
                            Chi Tiết Lương
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table class="c-table">
                                <tbody>
                                    <tr>
                                        <th><span> Nhân viên:</span></th>
                                        <td><span>{{$model->user->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th><span>Ngày nhận:</span></th>
                                        <td><span>{{$model->payday}}</span></td>
                                    </tr>
                                    <tr>
                                        <th><span>Tháng:</span></th>
                                        <td><span>{{$model->salary_month}}</span></td>
                                    </tr>
                                    <tr>
                                        <th><span> Trạng thái:</span></th>
                                        <td><span>{{$model->status_name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th> <span>Ghi chú:</span></th>
                                        <td> <textarea type="number" class="w-100" name="note" placeholder="Ghi chú" aria-label="note">{{$model->note}}</textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <table class="country-table table text-nowrap">
                            <thead>
                                <tr>
                                    <th>
                                        <div>Nhân viên</div>
                                    </th>
                                    <th>
                                        <div>Số đơn hàng trong tháng</div>
                                    </th>
                                    <th>
                                        <div>Doanh Thu</div>
                                    </th>
                                    <th>
                                        <div>Lương</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$model->user?->name}}
                                    </td>
                                    <td>
                                        {{$model->order_count}}
                                    </td>
                                    <td>
                                        {{$model->revenue_format}}
                                    </td>
                                    <td>
                                        {{$model->salary_format}}
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-bottom:none !important;"></td>
                                    <td style="border-bottom:none !important;"></td>
                                    <td class="text-end"><strong>Thưởng:</strong></td>
                                    <td><span class="text-success">{{$model->bonus}} đ</span></td>
                                </tr>

                                <tr>
                                    <td style="border-bottom:none !important;"></td>
                                    <td style="border-bottom:none !important;"></td>
                                    <td class="text-end"><strong>Thực nhận:</strong></td>
                                    <td><span class="text-success">{{$model->total_salary_format}}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary w-100">Chốt</button>
                        </div>
                    </div>
                    <div class="card-footer d-none border-top-0">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <style>
        .underline-input {
            border: none;
            border-bottom: solid #cacaca 1px;
            width: fit-content !important;
            text-align: center;
            max-width: fit-content !important;
        }

        .underline-input:focus {
            outline: none !important;
        }

        .table-wrapper {
            border-bottom: dashed 1px #cacaca;
            margin-bottom: 2.5rem;
        }

        table.c-table {
            width: 100%;
        }

        table.c-table tr {
            border-bottom: 12px solid transparent;
            line-height: 1.5rem;
        }

        table.c-table>tbody>tr>th {
            white-space: nowrap;
            width: 1px;
            border-right: 24px solid transparent;
            vertical-align: baseline;
        }

        table.c-table>tbody>tr>td {
            white-space: nowrap;
            width: auto;
        }
    </style>
    @endsection

    @section('script-footer')
    <script src="{{ asset('assets/js/prism-custom.js') }}"></script>

    <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script>
        $(document).ready(function() {
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

            $("#userForm").on('submit', (event) => {
                event.preventDefault();
                Swal.fire({
                    title: 'Chốt Đơn?',
                    html: `
                    <p>
                    Đơn hàng sẽ được chuyển sang trạng thái <strong>'Đợi Duyệt'</strong>, số lượng hàng còn lại sẽ được nhập vào kho. 
                    </p>
                    <p class="text-danger"> Sau khi chốt đơn chỉ quản lý mới có thể chỉnh sửa đơn hàng của bạn! </p>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                })
            })
        })
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