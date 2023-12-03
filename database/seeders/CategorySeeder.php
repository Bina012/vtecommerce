<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Survey and Mapping',
                'slug' => 'survey_and_mapping',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed suscipit nisi ut neque rutrum, et eleifend nulla vestibulum.',
            ],
            [
                'title' => 'Construction Safety',
                'slug' => 'construction_safety',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
            ],
            [
                'title' => 'Geotech Investigation',
                'slug' => 'geotech_investigation',
                'description' => 'Description for Geotech Investigation.',
            ],
            [
                'title' => 'Electricals',
                'slug' => 'electricals',
                'description' => 'Description for Electricals.',
            ],
            [
                'title' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Description for Electronics.',
            ],
            [
                'title' => 'Medical lab Equipment',
                'slug' => 'medical_lab_equipment',
                'description' => 'Description for Medical lab Equipment.',
            ],
            [
                'title' => 'Information Technology',
                'slug' => 'information_technology',
                'description' => 'Description for Information Technology.',
            ],
            [
                'title' => 'Agriculture and Forestry Investigation',
                'slug' => 'agriculture_and_forestry_investigation',
                'description' => 'Description for Agriculture and Forestry Investigation.',
            ],
            [
                'title' => 'Environmental Investigation',
                'slug' => 'environmental_investigation',
                'description' => 'Description for Environmental Investigation.',
            ],
            [
                'title' => 'Hydrology',
                'slug' => 'hydrology',
                'description' => 'Description for Hydrology.',
            ],
            [
                'title' => 'Meteorology',
                'slug' => 'meteorology',
                'description' => 'Description for Meteorology.',
            ],
            [
                'title' => 'Road Safety and Signals',
                'slug' => 'road_safety_and_signals',
                'description' => 'Description for Road Safety and Signals.',
            ],
        ];

        // Insert the categories into the database
        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}