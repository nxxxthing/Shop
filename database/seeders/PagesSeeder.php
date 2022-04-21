<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'name' => 'Main',
            'title' => 'main',
            'main_text' => 'This is main page',
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pages')->insert([
            'name' => 'About',
            'title' => 'about',
            'main_text' => 'This is about page',
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pages')->insert([
            'name' => 'Contacts',
            'title' => 'contacts',
            'main_text' => 'This is contacts page',
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
