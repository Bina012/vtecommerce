<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert([    
            'parent_id' => 0,   
            'office_name' => 'Test Store and Suppliers',   
            'office_address' => 'Narephant-Koteshwor-32,Kathmandu',
            'email_address' => 'thapapawan599@gmail.com',      
            'phone_number' => '9860305324',
            'focal_person_name' => 'Pawan Thapa',
            'fax' => '44600',
            'website' => 'www.test.com.np',
            'latitude' => 27.6696695,
            'longitude' => 85.350455,
            'logo_path' => 'storage/office/logo.png', 
            'is_active' => 1,   
         ]);  
    }
}
