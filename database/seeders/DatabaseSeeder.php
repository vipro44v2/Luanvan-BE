<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            'name'=>'Thế Vĩ',
            'email'=>'Thevyhoang21@gmail.com',
            'password'=>bcrypt('123456'),
            'id_card_number'=>'206352753',
            'phone_number'=>'0365636175',
            'img_avatar'=>'avatar.jpg',
            'staff_status_id'=>1
        ];
        DB::table('staffs')->insert($data);
    }
}
