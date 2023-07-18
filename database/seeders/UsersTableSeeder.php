<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'email' => 'admin@menu.com',
            'password' => Hash::make('secret'),
        ]);
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);
        $admin->assignRole($adminRole);
        $user = User::create([
            'email' => 'user@menu.com',
            'password' => Hash::make('secret'),
        ]);
        $userRole = Role::create([
            'name' => 'user',
            'guard_name' => 'api',
        ]);
        $user->assignRole($userRole);
        DB::table('roles')->insert([
            [
                'name' => 'business',
                'guard_name' => 'api',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
