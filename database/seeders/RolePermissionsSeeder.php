<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Tìm roles dựa trên tên roles
         $superadminRole = Role::where('name', 'superadmin')->first();
         $managerRole = Role::where('name', 'manager')->first();
         $storeEmployeeRole = Role::where('name', 'store_employee')->first();
         $fullTimeDriverRole = Role::where('name', 'full_time_driver')->first();
         $partTimeDriverRole = Role::where('name', 'part_time_driver')->first();
 
         // Tìm permissions dựa trên tên permissions
         $fullAccessPermission = Permission::where('name', 'full_access')->first();
         $inventoryPermission = Permission::where('name', 'inventory')->first();
         $accountingPermission = Permission::where('name', 'accounting')->first();
         $schedulePermission = Permission::where('name', 'schedule')->first();
         $leavePermission = Permission::where('name', 'leave')->first();
         $salaryPermission = Permission::where('name', 'salary')->first();
         $orderPermission = Permission::where('name', 'order')->first();
         $viewOrderConfirmationPermission = Permission::where('name', 'view_order_confirmation')->first();
         $noteForApprovalPermission = Permission::where('name', 'note_for_approval')->first();
 
         // Attach permissions to roles
         $superadminRole->permissions()->attach($fullAccessPermission);
         $managerRole->permissions()->attach($inventoryPermission);
         $managerRole->permissions()->attach($accountingPermission);
         $storeEmployeeRole->permissions()->attach($schedulePermission);
         $storeEmployeeRole->permissions()->attach($leavePermission);
         $storeEmployeeRole->permissions()->attach($salaryPermission);
         $fullTimeDriverRole->permissions()->attach($orderPermission);
         $fullTimeDriverRole->permissions()->attach($viewOrderConfirmationPermission);
         $fullTimeDriverRole->permissions()->attach($noteForApprovalPermission);
         $partTimeDriverRole->permissions()->attach($orderPermission);
         $partTimeDriverRole->permissions()->attach($viewOrderConfirmationPermission);
         $partTimeDriverRole->permissions()->attach($noteForApprovalPermission);
    
    }
}
