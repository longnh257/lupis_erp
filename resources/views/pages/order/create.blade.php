@extends('layouts.master')

@section('title', 'Order')

@section('content')
<form action="{{route('view.order.store')}}" method="post" enctype="multipart/form-data" class="container-fluid">
    @csrf
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
        <div>
            <h4 class="mb-0">Thêm đơn hàng</h4>
        </div>
        <div class="main-dashboard-header-right">
            <div class="d-flex my-xl-auto right-content align-items-center">
                <div>
                    <a href="{{route('view.order.index')}}" class="btn btn-danger btn-icon me-2 btn-b" title="Quay lại danh sách order">
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
    <div class="alert alert-danger mx-2" role="alert">
        {{ $error }}
    </div>
    @endforeach
    @endif
    @if (session('error'))
    <div class="alert alert-danger mx-2" role="alert">
        {{ session('error') }}
    </div>
    @endif

    <div class="row  mx-2">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Thông tin đơn hàng
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3 ">
                        <label class="form-label required">Nhân viên nhận đơn</label>
                        <select type="text" class="form-control" name="assigned_to">
                            @foreach($user as $item)
                            <option value="{{$item->id}}" {{old('id')==$item->id ? "selected" : ""}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 ">
                        <label class="form-label ">Ghi chú</label>
                        <textarea type="number" class="form-control" name="note" placeholder="Ghi chú" aria-label="note">{{ old('note') }}</textarea>
                    </div>

                    <span class="mb-0">Thêm đơn hàng cho đơn hàng</span>
                    <table class="table table-striped table-bordered mt-0 mb-0 mx-2 text-nowrap gridjs-table" id='list-data' data-product="{{$product}}">
                        <thead class="gridjs-thead">
                            <tr class="gridjs-tr">
                                <th class="gridjs-th gridjs-th-sort " style="width: 70px;">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">STT</div>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Sản Phẩm</div>
                                        <button class="btn btn-outline-light btn-wave waves-effect waves-light">
                                            <i class="fe fe-maximize-2"></i>
                                        </button>
                                    </div>
                                </th>

                                <th class="gridjs-th gridjs-th-sort">
                                    <div class="flex-between-center">
                                        <div class="gridjs-th-content">Số Lượng</div>
                                        <button class="btn btn-outline-success btn-wave waves-effect waves-light">
                                            <i class="fe fe-arrow-down"></i>
                                        </button>
                                    </div>
                                </th>

                                <th class="text-end" style="width: 50px;">
                                    <a @click="addAttr()" class="btn btn-info btn-icon btn-b">
                                        <i class="fe fe-plus"></i></a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,key) in attributes" :class="'attr-' + key" :key="key">
                                <td class="text-center">((key+1))</td>
                                <td class="fw-medium">
                                    <select class="form-control" :name="'attr[' + key + '][product_id]'" v-model="item.product_id">
                                        <!-- Your options go here -->
                                        <option v-for="item in prods" :value="item.id">((item.name))</option>
                                    </select>
                                    <!--   <input type="text" :name="'attr[' + key + '][attribute_name]'" v-model="item.attribute_name" class="form-control" value=""> -->
                                </td>
                                <td class="fw-medium">
                                    <input type="text" :name="'attr[' + key + '][quantity]'" v-model="item.quantity" class="form-control" value="">
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap justify-content-center" v-if="key != 0">
                                        <a href="##" @click="deleteAttr(item)" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript">
    var CSRF_TOKEN = jQuery('meta[name="csrf-token"]').attr('content');
    var S_HYPEN = "-";
    var options = {}
    var notifier = new AWN(options);

    new Vue({
        el: '#list-data',
        data: {
            attributes: [{
                'product_id': '',
                'quantity': ''
            }, ],
            prods: [],
            key: 0,
        },
        delimiters: ["((", "))"],
        mounted() {
            const product = this.$el.getAttribute('data-product')
            this.prods = JSON.parse(product)
            $('#mySelect-' + this.key).select2({
                placeholder: 'Chọn một mục',
                allowClear: true
            });
            console.log('prods' + this.prods);
        },
        computed: {},
        methods: {
            addAttr() {
                this.attributes.push({
                    'product_id': '',
                    'quantity': ''
                });
                this.key += 1;
                setTimeout(() => {
                    $('#mySelect-' + this.key).select2({
                        placeholder: 'Chọn một mục',
                        allowClear: true
                    });
                }, 1);
            },
            deleteAttr(item) {
                /*  cl = '.attr-' + item
                 jQuery(cl).remove() */
                const index = this.attributes.indexOf(item);
                console.log(index);
                if (index !== -1) {
                    this.attributes.splice(index, 1);
                }
            },
        }

    });
</script>
@endsection