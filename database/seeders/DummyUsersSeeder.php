<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'password'=>bcrypt('12345678')
            ],
            [
                'name'=>'Customer',
                'email'=>'customer@gmail.com',
                'role'=>'customer',
                'password'=>bcrypt('12345678')
            ],
            [
                'name'=>'Seller',
                'email'=>'seller@gmail.com',
                'role'=>'seller',
                'password'=>bcrypt('12345678')
            ],
        ];
        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
