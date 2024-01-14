<?php

namespace App\Http\Controllers\Pages;

use App\Enums\OrderStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.order.index');
    }

    public function create()
    {
        $user = User::whereIn('role_id', [UserRole::part_time_driver, UserRole::full_time_driver])->get();
        $product = Product::where('quantity', '>', 0)->get();
        return view('pages.order.create', compact('user', 'product'));
    }


    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();
        $request->validate(
            [
                'assigned_to' => 'required',

            ],
            trans('orderValidation.messages'),
            trans('orderValidation.attributes'),
        );

        $collection = collect($request->attr);

        // Sử dụng filter để loại bỏ các sản phẩm có quantity = 0 hoặc không có quantity
        $filteredCollection = $collection->filter(function ($item) {
            return isset($item['quantity']) && (int)$item['quantity'] !== 0;
        });

        $result = $filteredCollection->groupBy('product_id')->mapWithKeys(function ($group, $productId) {
            return [$productId => $group->sum('quantity')];
        });


        $order =  Order::create([
            'user_id' => Auth::id(), //người tạo
            'assigned_to' => $request->assigned_to, //người nhận order
            'status' => OrderStatus::INPROGRESS,
            'order_date' => now(),
        ]);

        $resultArray = $result->all();
        if (empty($resultArray)) {
            DB::rollBack();
            return redirect()->back()->with('error', "Vui lòng nhập sản phẩm cho đơn hàng.");
        } else {
            foreach ($resultArray as $product_id => $quantity) {
                $product = Product::find($product_id);
                if ($product->quantity >=  $quantity) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ]);

                    $product->quantity = $product->quantity - $quantity;
                    $product->save();
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Số lượng nhập vào nhiều hơn số lượng tồn kho!");
                }
            }
        }
        DB::commit();
        return redirect()->route('view.order.index')
            ->with('success', 'Tạo đơn hàng thành công!');
    }

    public function edit(Order $model)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('pages.order.edit', compact('roles', 'model'));
    }

    public function update(Order $model, Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:191|unique:orders,name,' . $model->id . ',id',
                'quantity' => 'numeric',
                'file' => 'mimes:jpg,png,jpeg|max:4096',
            ],
            trans('orderValidation.messages'),
            trans('orderValidation.attributes'),
        );

        $cred = [
            "name" => $request->name,
            "quantity" => $request->quantity,
            "description" => $request->description,
        ];

        if ($request->file) {
            $file = $request->file('file');
            $yearMonth = date('Y') . '/' . date('m') . '/';
            $fileName = $yearMonth . uniqid() . '.' . $file->getClientOriginalName();
            Storage::disk('local')->put('public/uploads/' . $fileName, file_get_contents($file));
            $cred['thumbnail'] = $fileName;
        }

        $model->update($cred);

        return redirect()->route('view.order.index')
            ->with('success', 'Cập nhật thành công!');
    }


    public function destroy(Order $model)
    {
        $model->status = OrderStatus::CANCEL;
        $model->save();

        return redirect()->route('view.order.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
