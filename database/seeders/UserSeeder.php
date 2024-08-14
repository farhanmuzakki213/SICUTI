<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert users
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'karyawan1',
                'email' => 'karyawan1@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'karyawan2',
                'email' => 'karyawan2@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'karyawan3',
                'email' => 'karyawan3@example.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Create roles
        $managerRole = Role::create(['name' => 'manager']);
        $assistantRole = Role::create(['name' => 'assistant']);
        $staffRole = Role::create(['name' => 'staff']);
        $employeeRole = Role::create(['name' => 'employee']);

        // Assign roles to users
        User::where('email', 'john@example.com')->first()->assignRole('manager');
        User::where('email', 'jane@example.com')->first()->assignRole('assistant');
        User::where('email', 'alice@example.com')->first()->assignRole('staff');
        User::whereIn('email', ['karyawan1@example.com', 'karyawan2@example.com', 'karyawan3@example.com'])->each(function ($user) use ($employeeRole) {
            $user->assignRole('employee');
        });
    }
}
