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
use Carbon\Carbon;
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
        $users = User::where('id', '!=',  1)->whereHas('salary_config')->with(['salary_config'])->get();
        $month = Carbon::parse($request->month)->format('m');
        $year = Carbon::parse($request->month)->format('Y');
        $startDate = Carbon::createFromDate($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        foreach ($users as $user) {
            // tính lương cho nhân viên theo ca
            if ($user->salary_config->salary_type == 'by_shift') {
                $user->loadCount([
                    'events as work_shift_count' => function ($query) use ($startDate, $endDate) {
                        $query->where('event_type', 'work')->whereBetween('start', [$startDate, $endDate]);
                    }
                ]);
                $shift_count = $user->work_shift_count;
                $basic_salary = $user->salary_config->basic_salary;
                $basic_salary_per_shift = $user->salary_config->basic_salary_per_shift;
                $bonus_percentage = $user->salary_config->bonus_percentage;
                $revenue_percentage = $user->salary_config->revenue_percentage;

                $salary = $basic_salary_per_shift * $shift_count;
                $bonus = 0;
                $total_salary = $salary + $bonus;
                $user->salary_details()->create([
                    'salary_month' => $request->month,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'shift_count' => $shift_count,
                    'basic_salary' => $basic_salary,
                    'basic_salary_per_shift' => $basic_salary_per_shift,
                    'bonus_percentage' => $bonus_percentage,
                    'revenue_percentage' => $revenue_percentage,
                    'salary' => $salary,
                    'bonus' => $bonus,
                    'total_salary' => $total_salary,
                    'payday' => $request->payday,
                ]);
            }

            // tính lương cho nhân viên theo lợi nhuận
            if ($user->salary_config->salary_type == 'by_revenue') {
            }
        }
        // Start a database transaction

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
