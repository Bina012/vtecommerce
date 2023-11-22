<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([    
            'fullname' => 'Pawan Thapa',   
            'address' => 'Koteshwor-32,Kathmandu',   
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),      
            'phone_number' => '9860305324',   
            'active_status' => 1,
            'office_id' => 1   
         ]);  
    }
}
