<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    
            // Superadmin: toàn quyền
            Permission::create([
                'name' => 'full_access',
                'description' => 'Full access for superadmin',
            ]);
    
            // Quản lý : Nhập kho , xuất kho , chốt sổ, tính lương
            Permission::create([
                'name' => 'inventory',
                'description' => 'Inventory management permission',
            ]);
    
            Permission::create([
                'name' => 'accounting',
                'description' => 'Accounting permission',
            ]);
    
            // Nhân Viên Cửa Hàng : Chỉ xem lịch và thêm lịch làm việc , đăng ký nghỉ phép, xem bảng lương
            Permission::create([
                'name' => 'schedule',
                'description' => 'Schedule management permission',
            ]);
    
            Permission::create([
                'name' => 'leave',
                'description' => 'Leave management permission',
            ]);
    
            Permission::create([
                'name' => 'salary',
                'description' => 'Salary management permission',
            ]);
    
            // Xe Full Time : nhập đơn hàng , xem chốt đơn hàng mỗi ngày (đã nhập không sửa nhưng được quyền note lại đơn hàng chờ quản lý duyệt)
            Permission::create([
                'name' => 'order',
                'description' => 'Order entry permission',
            ]);
    
            Permission::create([
                'name' => 'view_order_confirmation',
                'description' => 'View order confirmation permission',
            ]);
    
            Permission::create([
                'name' => 'note_for_approval',
                'description' => 'Note for approval permission',
            ]);
    }
}
