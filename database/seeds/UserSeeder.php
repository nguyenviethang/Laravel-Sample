<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'email' => 'admin@gmail.com', //email
                'password' => Hash::make('123456a'), // password:password
                'fullname' => 'admin', // tên
                'phone' => '0987654321', // số điện thoại
                'avatar' => 'default.png',
                'birth_day' => '2001-01-11', // ngày sinh
                'start_date' => '2021-01-11', //ngày bắt đầu làm việc
                'department_id' => 1, //phòng hành chính
                'role_id' => 1, //manager
                'is_admin' => 1, //admin
                'is_first_login' => 0, //1: lần đầu đăng nhập,0: lần tiếp theo
                'status' => 1, // 1:đang làm việc, 2:đã nghỉ việc
            ]
        );
    }
}
