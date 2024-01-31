<?php

namespace App\Http\Controllers\Pages;

use App\Enums\OrderStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductLog;
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
            'status' => "IN_PROGRESS",
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
                    $item = OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                    ]);

                    $product->quantity = $product->quantity - $quantity;
                    $product->save();


                    ProductLog::create([
                        'user_id' => Auth::id(),
                        'order_id' => $order->id,
                        'action' => "export",
                        'details' => "Xuất Kho",
                        'quantity' => $quantity,
                        'product_id' => $product_id,
                    ]);
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
        if ($model->is_editable) {
            return view('pages.order.edit', compact('model'));
        } else {
            abort(403);
        }
    }

    public function update(Order $model, Request $request)
    {
        $request->validate(
            [
                'sell_quantity.*' => 'numeric',
            ],
            trans('orderValidation.messages'),
            trans('orderValidation.attributes'),
        );


        foreach ($request->sell_quantity as $key => $item) {
            $order_item = OrderItem::find($key);
            $order_item->update([
                'sell_price' => $order_item->sell_price ? $order_item->sell_price :  $order_item->product->price,
                'sell_quantity' => $item,
            ]);
            if ($item < $order_item->quantity) {
                $order_item->product->update(['quantity' => $order_item->product->quantity + $order_item->quantity - $item]);

                ProductLog::create([
                    'user_id' => Auth::id(),
                    'order_id' => $model->id,
                    'action' => "import",
                    'details' => "Trả hàng chốt đơn",
                    'quantity' => $order_item->quantity - $item,
                    'product_id' =>   $order_item->product->id,
                ]);
            }
        }


        $model->update([
            'note' => $request->note,
            'status' => 'completed',
        ]);

        return redirect()->route('view.order.index')
            ->with('success', 'Chốt đơn thành công!');
    }

    public function staff_update(Order $model, Request $request)
    {
        if (!$model->staff_updated) {
            $request->validate(
                [
                    'sell_quantity.*' => 'numeric',
                ],
                trans('orderValidation.messages'),
                trans('orderValidation.attributes'),
            );

            foreach ($request->sell_quantity as $key => $item) {
                $order_item = OrderItem::find($key);
                $order_item->update([
                    'sell_price' =>  $order_item->product->price,
                    'sell_quantity' => $item,
                ]);
            }

            $model->update([
                'note' => $request->note,
                'status' => 'pending',
                'staff_updated' => true,
            ]);
        } else {
            $model->update([
                'note' => $request->note,
            ]);
        }

        return redirect()->route('view.order.index')
            ->with('success', 'Cập nhật thành công, vui lòng đợi quản lý xét duyệt!<br>
            Lưu ý, Đơn hàng này đã được chôt, bạn không thể sửa số lượng đã bán, 
            nếu có vấn đề vui lòng liên hệ Quản Lý');
    }


    public function destroy(Order $model)
    {
        $model->status = 'cancel';
        $model->save();

        return redirect()->route('view.order.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
