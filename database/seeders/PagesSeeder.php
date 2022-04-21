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
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('content')->insert([
            'pages_id' => 1,
            'language' => 'en',
            'name' => 'Main',
            'title' => 'Main',
            'main_text' => 'This is main page',
        ]);
        DB::table('content')->insert([
            'pages_id' => 1,
            'language' => 'ua',
            'name' => 'Головна',
            'title' => 'Головна',
            'main_text' => 'Ви на головній сторінці',
        ]);


        DB::table('pages')->insert([
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('content')->insert([
            'pages_id' => 2,
            'language' => 'en',
            'name' => 'About',
            'title' => 'About',
            'main_text' => 'This is about page',
        ]);
        DB::table('content')->insert([
            'pages_id' => 2,
            'language' => 'ua',
            'name' => 'Про нас',
            'title' => 'Про нас',
            'main_text' => 'Ви на сторінці Про нас',
        ]);


        DB::table('pages')->insert([
            'bg_image' => 'bg1.jpeg',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('content')->insert([
            'pages_id' => 3,
            'language' => 'en',
            'name' => 'Contacts',
            'title' => 'Contacts',
            'main_text' => 'This is contacts page',
        ]);
        DB::table('content')->insert([
            'pages_id' => 3,
            'language' => 'ua',
            'name' => 'Контакти',
            'title' => 'Контакти',
            'main_text' => 'Ви на сторінці Контакти',
        ]);
    }
}
