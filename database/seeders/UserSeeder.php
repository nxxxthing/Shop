<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@admin.com')->exists()) {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin123')
            ]);
            $admin->save();
        }
        User::factory()
            ->count(10)
            ->create();




        if (!DB::table('roles')->where('name', 'super-admin')->exists())
            Role::create(['name' => 'super-admin']);

        if (!DB::table('roles')->where('name', 'admin')->exists())
            Role::create(['name' => 'admin']);

        if (!DB::table('roles')->where('name', 'user')->exists())
            Role::create(['name' => 'user']);
        foreach (User::without('role')->get() as $user) {
            if ($user['name'] == 'admin') $user->assignRole('super-admin');
            else $user->assignRole('user');
        }
    }
}
