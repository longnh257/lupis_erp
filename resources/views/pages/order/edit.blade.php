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

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger mx-4" role="alert">
    {!! $error !!}
</div>
@endforeach
@endif
@if(in_array(Auth::user()->role->name, ['superadmin', 'manager']))
<form action="{{route('view.order.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @else
    <form action="{{route('view.order.staff-update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
        @endif
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-6">
                <div class="card custom-card">
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
                                        <div>
                                            <div>Sản Phẩm</div>
                                        </div>
                                    </th>

                                    <th>
                                        <div>
                                            <div>Số Lượng</div>
                                        </div>
                                    </th>

                                    <th>
                                        <div>
                                            <div class="required">Đã Bán</div>
                                        </div>
                                    </th>

                                    <th>
                                        <div>
                                            <div>Đơn giá</div>
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            <div>Tổng</div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model->order_items as $key => $item)
                                <tr>
                                    <td>
                                        #{{$key + 1}} &nbsp;
                                        {{$item->product->name}}
                                    </td>
                                    <td>
                                        {{$item->quantity}}
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" name="sell_quantity[{{$item->id}}]" max="{{$item->sell_quantity}}" value="{{$item->sell_quantity}}" class="underline-input ">
                                    </td>
                                    <td>
                                        {{$item->sell_price_format}}
                                    </td>
                                    <td>
                                        {{$item->revenue_format}}
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end"><strong>Tổng Doanh Thu:</strong></td>
                                    <td><span>{{$model->revenue}}</span></td>
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


    @endsection