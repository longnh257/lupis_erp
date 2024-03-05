@extends('layouts.master')

@section('title', 'Product')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div>
        <h4 class="mb-0">Chỉnh sửa đơn hàng</h4>
        <p class="mb-0 text-muted">Chỉnh sửa đơn hàng, chốt đơn</p>
    </div>
</div>
<!-- End Page Header -->

@if(in_array(Auth::user()->role->name, ['superadmin', 'manager']))
<form action="{{route('view.order.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @else
    <form action="{{route('view.order.staff-update',$model->id)}}" @if($model->status == 'in_progress') id="userForm" @endif method="post" enctype="multipart/form-data" class="container-fluid">
        @endif
        @csrf
        @method('PUT')

        <div class="row" id="app" data-orderItems="{{$model->order_items}}">
            <div class="col-xl-6">
                <div class="card custom-card">
                    @if($model->status != 'in_progress')
                    <div class="alert alert-warning m-2 text-center" role="alert">
                        Đơn hàng đã được chốt, Nhân viên chỉ có thể ghi chú và nhờ quản lý chỉnh sửa đơn hàng!
                    </div>
                    @endif
                    <div class=" p-4 pb-2">
                        <h4 class=" text-center">
                            Thông Tin Đơn Hàng #{{$model->id}}
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-wrapper">
                            <table class="c-table">
                                <tbody>
                                    <tr>
                                        <th><span> Nhân viên nhận đơn:</span></th>
                                        <td><span>{{$model->assigned_user->name}}</span></td>
                                    </tr>
                                    <tr>
                                        <th><span> Ngày:</span></th>
                                        <td><span>{{$model->order_date}}</span></td>
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
                                        <div>Sản Phẩm</div>
                                    </th>

                                    <th>
                                        <div>Số Lượng</div>
                                    </th>

                                    <th>
                                        <div class="required">Đã Bán</div>
                                    </th>
                                    <th>
                                        <div>Còn Lại</div>
                                    </th>

                                    <th>
                                        <div>Đơn giá</div>
                                    </th>
                                    <th>
                                        <div>Tổng</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in orderItems">
                                    <td>
                                        ((item.product?.name))
                                    </td>
                                    <td>
                                        ((item.quantity))
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" :name="`sell_quantity[${item.id}]`" v-model="item.sell_quantity" @change="checkMax(item)" class="underline-input text-success">
                                    </td>
                                    <td>
                                        <span class="text-danger"> (( currencyFormat(item.quantity - item.sell_quantity) ))</span>
                                    </td>
                                    <td>
                                        (( currencyFormat(item.sell_price_format) ))
                                    </td>
                                    <td>
                                        (( currencyFormat(item.sell_quantity * item.sell_price) ))đ
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end"><strong>Tổng Doanh Thu:</strong></td>
                                    <td><span class="text-success">(( currencyFormat( sumSalary(orderItems) ) ))đ</span></td>
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
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.currentTarget.submit();
                    }
                })
            })
        })
    </script>


    <script type="text/javascript">
        new Vue({
            el: '#app',
            data: {
                orderItems: [],
                offices: [],
                selectedCompany: ""
            },
            delimiters: ["((", "))"],
            mounted() {
                const orderItems = this.$el.getAttribute('data-orderItems')
                console.log(orderItems);
                this.orderItems = JSON.parse(orderItems)
            },
            computed: {},

            methods: {
                currencyFormat(number) {
                    if (number !== null && number !== undefined && !isNaN(number)) {
                        return number.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                    }
                    return '0 ';
                },
                sumSalary() {
                    let sum = 0;
                    this.orderItems.map((item) => {
                        sum += parseInt(item.sell_quantity) * parseInt(item.sell_price);
                    });
                    return sum;
                },

                checkMax(item) {
                    let sellQuantity = parseFloat(item.sell_quantity);

                    console.log(sellQuantity);
                    if (isNaN(sellQuantity)) {
                        item.sell_quantity = '';
                        return;
                    }

                    // Limit to two decimal places
                    item.sell_quantity = sellQuantity.toFixed(2);

                    if (parseFloat(item.sell_quantity) > parseFloat(item.quantity)) {
                        item.sell_quantity = item.quantity
                    }
                }
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