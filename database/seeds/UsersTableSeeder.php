<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => 'Thành viên 1',
                'email' => 'thanhvien' . $i . '@gmail.com',
                'phone' => '0342956209',
                'address' => 'Hoài Đức, Hà Nội',
                'role' => 1,
                'password' => bcrypt('123')
            ]);
        }
    }
}
