<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo role "superadmin"
        $superadminRole = Role::create([
            'name' => 'superadmin',
            'nice_name' => 'Super Admin',
            'description' => 'Superadmin with full access',
        ]);

        // Tạo user với role "superadmin"
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => $superadminRole->id,
        ]);
    }
}
