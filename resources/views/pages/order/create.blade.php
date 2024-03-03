@extends('layouts.master')

@section('title', 'Order')

@section('content')
<form action="{{route('view.order.store')}}" @submit.prevent="submit()" method="post" enctype="multipart/form-data" class="container-fluid" id='App' data-product="{{$product}}">
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
        {!! $error !!}
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

                    <div class="col-md-12 mb-3 ">
                        <label class="form-label ">Ghi chú</label>
                        <textarea type="number" class="form-control" name="note" placeholder="Ghi chú" aria-label="note">{{ old('note') }}</textarea>
                    </div>

                    <strong class="mb-0">Thêm sản phẩm vào đơn hàng</strong>
                    <div class="col-12 d-flex gap-3">
                        <div class="flex-1 mb-3">
                            <select class="form-control" :name="'products[' + key + '][product_id]'" v-model="selected_prod.id" id="product_select2">
                                <!-- Your options go here -->
                                <option value="">Chọn một sản phẩm</option>
                                <option v-for="item in prods" :value="item.id">((item.id + " - " + item.name + " - còn lại: " + item.quantity))</option>
                            </select>
                        </div>
                        <div class="flex-0 mb-3 text-nowrap">
                            <input type="number" step="0.1" placeholder="Số lượng" :name="'products[' + key + '][quantity]'" v-model="selected_prod.quantity" class="form-control" value="" style="min-width:200px; height:38px">
                        </div>
                        <div class="flex-0 align-self-end mb-3 text-nowrap">
                            <a @click="addAttr()" class="btn btn-info  btn-b" style="height:38px">
                                <i class="fe fe-plus"></i> Thêm</a>
                        </div>
                    </div>

                    <table class="table  table-bordered mt-0 mb-0 mx-2 text-nowrap gridjs-table">
                        <thead class="gridjs-thead">
                            <tr class="gridjs-tr">
                                <th class="gridjs-th gridjs-th-sort " style="width: 70px;">
                                    <div>
                                        <div class="gridjs-th-content">ID</div>
                                    </div>
                                </th>
                                <th class="gridjs-th gridjs-th-sort ">
                                    <div>
                                        <div class="gridjs-th-content">Sản Phẩm</div>
                                    </div>
                                </th>

                                <th class="gridjs-th gridjs-th-sort">
                                    <div>
                                        <div class="gridjs-th-content">Số Lượng</div>
                                    </div>
                                </th>

                                <th class="text-end" style="width: 50px;">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,key) in products" :class="'products-' + key" :key="key">
                                <td class="text-center">
                                    ((item.id))
                                    <input type="hidden" :name="'products[' + key + '][id]'" v-model="item.id" class="form-control" value="">
                                </td>
                                <td class="fw-medium">
                                    ((item.name))
                                    <input type="hidden" :name="'products[' + key + '][name]'" v-model="item.name" class="form-control" value="">
                                </td>
                                <td class="fw-medium">
                                    ((item.quantity))
                                    <input type="hidden" step="0.1" :name="'products[' + key + '][quantity]'" v-model="item.quantity" class="form-control" value="">
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap justify-content-center">
                                        <a href="##" @click="deleteAttr(item)" class="text-danger fs-14 lh-1"><i class="ri-delete-bin-5-line"></i></a>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Tạo đơn</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js" integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
            products: [],
            selected_prod: {
                'id': 0,
                'name': '',
                'quantity': '',
                'quantity_left': 0
            },
            prods: [],
            key: 0,
        },
        delimiters: ["((", "))"],
        mounted() {
            const prods = this.$el.getAttribute('data-product')
            this.prods = JSON.parse(prods)
            const that = this

            $("#product_select2").select2({
                placeholder: 'Chọn một sản phẩm',
                allowClear: true
            }).on('select2:select', (e) => {
                let id = parseInt(e.target.value)
                let obj = _.find(this.prods, {
                    id: id
                });
                that.selected_prod.id = obj.id
                that.selected_prod.name = obj.name
                that.selected_prod.quantity_left = obj.quantity
            });
        },
        computed: {},
        methods: {
            select2Init() {
                $('#product_select2').select2('destroy');
                setTimeout(() => {
                    $("#product_select2").select2({
                        placeholder: 'Chọn một sản phẩm',
                        allowClear: true
                    }).on('select2:select', (e) => {
                        let id = parseInt(e.target.value)
                        let obj = _.find(this.prods, {
                            id: id
                        });
                        this.selected_prod.id = obj.id
                        this.selected_prod.name = obj.name
                        this.selected_prod.quantity_left = obj.quantity
                    });
                }, 10);
            },
            addAttr() {
                //check nếu chưa chọn sp hoặc số lượng nhập vào > số lượng còn lại thì không cho thêm
                let quantity = parseFloat(this.selected_prod.quantity)
                let quantity_left = parseFloat(this.selected_prod.quantity_left)
                if (quantity_left == 0) {
                    notifier.alert(`Vui lòng chọn sản phẩm khác!`);
                    return;
                }
                if (!this.selected_prod.id || !quantity) {
                    notifier.alert(`Hãy chọn 1 sản phẩm và nhập số lượng`);
                    return;
                }

                if (quantity <= 0 || quantity_left <= 0 || quantity > quantity_left) {
                    notifier.alert(`Số lượng sản phẩm nhập vào phải lớn hơn 0 và nhỏ hơn ${quantity_left}`);
                    quantity = 0
                    return;
                }
                //kiểm tra nếu list thêm vào đã có sản phẩm thì + thêm, còn ko có thì thêm mới
                let i = _.findIndex(this.products, {
                    id: this.selected_prod.id
                })
                if (i === -1) {
                    this.products.push({
                        id: this.selected_prod.id,
                        name: this.selected_prod.name,
                        quantity: quantity,
                    });
                } else {
                    this.products[i].quantity += parseFloat(this.selected_prod.quantity)
                }
                console.log(1);
                //sau khi thêm sẽ reset select 2 để thay đổi số lượng còn lại
                let key = _.findIndex(this.prods, {
                    id: this.selected_prod.id
                });
                this.prods[key].quantity = this.selected_prod.quantity_left - this.selected_prod.quantity

                this.key += 1
                this.select2Init()
                this.resetSelectedProd()
            },
            resetSelectedProd() {
                this.selected_prod = Object.assign({}, {
                    'id': 0,
                    'name': '',
                    'quantity': '',
                    'quantity_left': 0
                });
            },
            deleteAttr(item) {
                const index = this.products.indexOf(item);
                let key = _.findIndex(this.prods, {
                    id: item.id
                });
                this.prods[key].quantity += item.quantity
                this.select2Init()
                if (index !== -1) {
                    this.products.splice(index, 1);
                }
            },
            submit() {
                if (this.products.length > 0) {
                    this.$el.submit()
                } else {
                    notifier.alert(`Vui lòng nhập ít nhất 1 sản phẩm!`);
                }
            }
        }

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