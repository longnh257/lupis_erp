<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Quản lý : Nhập kho , xuất kho , chốt sổ, tính lương
        Role::create([
            'name' => 'manager',
            'nice_name' => 'Quản Lý',
            'description' => 'Manager with permissions for inventory, accounting, etc.',
        ]);

        // Nhân Viên Cửa Hàng : Chỉ xem lịch và thêm lịch làm việc , đăng ký nghỉ phép, xem bảng lương
        Role::create([
            'name' => 'store_employee',
            'nice_name' => 'Nhân Viên Cửa Hàng',
            'description' => 'Store Employee with permissions for viewing schedules, adding schedules, requesting leave, viewing salary',
        ]);

        // Xe Full Time : nhập đơn hàng , xem chốt đơn hàng mỗi ngày (đã nhập không sửa nhưng được quyền note lại đơn hàng chờ quản lý duyệt)
        Role::create([
            'name' => 'full_time_driver',
            'nice_name' => 'Lái Xe Full Time',
            'description' => 'Full Time Driver with permissions for entering orders, viewing daily order confirmations (cannot edit), noting orders for manager approval',
        ]);

        // Xe partime : như xe full time
        Role::create([
            'name' => 'part_time_driver',
            'nice_name' => 'Lái Xe Part Time',
            'description' => 'Part Time Driver with permissions similar to full-time driver',
        ]);
    }
}
