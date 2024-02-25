<?php

namespace App\Http\Controllers\Pages;

use App\Enums\SalaryDetailStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\SalaryDetail;
use App\Models\SalaryDetailItem;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SalaryPageController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.salary.index');
    }

    public function create()
    {
        $user = User::whereIn('role_id', [UserRole::part_time_driver, UserRole::full_time_driver])->get();
        $product = Product::where('quantity', '>', 0)->get();
        return view('pages.salary.create', compact('user', 'product'));
    }


    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();
        $request->validate(
            [
                'assigned_to' => 'required',

            ],
            trans('salaryValidation.messages'),
            trans('salaryValidation.attributes'),
        );

        $collection = collect($request->attr);

        // Sử dụng filter để loại bỏ các sản phẩm có quantity = 0 hoặc không có quantity
        $filteredCollection = $collection->filter(function ($item) {
            return isset($item['quantity']) && (int)$item['quantity'] !== 0;
        });

        $result = $filteredCollection->groupBy('product_id')->mapWithKeys(function ($group, $productId) {
            return [$productId => $group->sum('quantity')];
        });


        $resultArray = $result->all();
        if (empty($resultArray)) {
            DB::rollBack();
            return redirect()->back()->with('error', "Vui lòng nhập sản phẩm cho đơn hàng.");
        } else {
            foreach ($resultArray as $product_id => $quantity) {
                $product = Product::find($product_id);
                if ($product->quantity >=  $quantity) {
                  

                    $product->quantity = $product->quantity - $quantity;
                    $product->save();
                } else {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Số lượng nhập vào nhiều hơn số lượng tồn kho!");
                }
            }
        }
        DB::commit();
        return redirect()->route('view.salary.index')
            ->with('success', 'Tạo đơn hàng thành công!');
    }

    public function edit(SalaryDetail $model)
    {
        if ($model->is_editable) {
            return view('pages.salary.edit', compact('model'));
        } else {
            abort(403);
        }
    }

    public function update(SalaryDetail $model, Request $request)
    {
        $request->validate(
            [
                'sell_quantity.*' => 'numeric',
            ],
            trans('salaryValidation.messages'),
            trans('salaryValidation.attributes'),
        );


        $model->update([
            'note' => $request->note,
            'status' => 'completed',
        ]);

        return redirect()->route('view.salary.index')
            ->with('success', 'Chốt đơn thành công!');
    }

    public function staff_update(SalaryDetail $model, Request $request)
    {
        if (!$model->staff_updated) {
            $request->validate(
                [
                    'sell_quantity.*' => 'numeric',
                ],
                trans('salaryValidation.messages'),
                trans('salaryValidation.attributes'),
            );

        } else {
            $model->update([
                'note' => $request->note,
            ]);
        }

        return redirect()->route('view.salary.index')
            ->with('success', 'Cập nhật thành công, vui lòng đợi quản lý xét duyệt!<br>
            Lưu ý, Đơn hàng này đã được chôt, bạn không thể sửa số lượng đã bán, 
            nếu có vấn đề vui lòng liên hệ Quản Lý');
    }


    public function destroy(SalaryDetail $model)
    {
        $model->status = 'cancel';
        $model->save();

        return redirect()->route('view.salary.index')
            ->with('success', 'Xóa Thành Công!');
    }
}
