@extends('layouts.master')

@section('title', 'Product')

@section('content')

<!-- Page Header -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
    <div>
        <h4 class="mb-0">{{ trans('order.order_edit') }}</h4>
        <p class="mb-0 text-muted">{{ trans('order.order_edit_desc') }}</p>
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
<form action="{{route('view.order.update',$model->id)}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xl-6">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Thông Tin Đơn Hàng
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label required">Nhân viên nhận đơn</label>
                            <input type="text" class="form-control" name="note" value="{{$model->assigned_user->name}}" placeholder="Ghi chú" disabled aria-label="note" />
                        </div>

                        <div class="col-md-6 mb-3 ">
                            <label class="form-label ">Ghi chú</label>
                            <textarea type="number" class="form-control" name="note" placeholder="Ghi chú" aria-label="note">{{ old('note') }}</textarea>
                        </div>

                        <span class="mb-0">Chốt đơn</span>
                        <table class="table table-striped table-bordered mt-0 mb-0 mx-2 text-nowrap gridjs-table">
                            <thead class="gridjs-thead">
                                <tr class="gridjs-tr">

                                    <th class="gridjs-th gridjs-th-sort ">
                                        <div class="flex-between-center">
                                            <div class="gridjs-th-content">Sản Phẩm</div>
                                        </div>
                                    </th>

                                    <th class="gridjs-th gridjs-th-sort">
                                        <div class="flex-between-center">
                                            <div class="gridjs-th-content">Số Lượng</div>
                                        </div>
                                    </th>

                                    <th class="gridjs-th gridjs-th-sort">
                                        <div class="flex-between-center">
                                            <div class="gridjs-th-content">Số Lượng</div>
                                        </div>
                                    </th>

                                    <th class="text-end" style="width: 50px;">
                                        <a @click="addAttr()" class="btn btn-info btn-icon btn-b">
                                            <i class="fe fe-plus"></i></a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($model->order_items as $item)
                                <tr>
                                    <td>
                                        {{$item->product->name}}
                                    </td>
                                    <td>
                                        <input type="number" step="0.1" name="attr[{{$item->id}}][quantity]" class="form-control" value="{{$item->quantity}}">
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 flex-wrap justify-content-center" v-if="key != 0">
                                            <a href="##" @click="deleteAttr(item)" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary">Thêm</button>
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